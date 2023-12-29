<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function showUserMenu() {
        return view('admin.anggota');
    }

    public function showSimpananMenu() {
        return view('admin.simpanan');
    }

    public function showTabunganMenu() {
        return view('admin.tabungan');
    }

    public function showKreditMenu() {
        return view('admin.kredit');
    }

    public function showAngsuranMenu() {
        return view('admin.angsuran');
    }

    public function showFormData() {
        $parameter = Route::currentRouteName();

        if ($parameter == "admin.add.simpanan.deposit") {
            $member = User::where('status', 2)->get();
            return view('admin.simpanan-deposit-create', compact('member'));
        } elseif ($parameter == "add.simpanan.withdrawal") {
            return view('admin.kredit');
        }
    }

    public function checkSimpananWajib(Request $request) {
        $memberId = $request->input('memberId');

        $user = User::with(['userAccount' => function ($query) {
            $query->where('kind', 'wajib');
        }])->where('memberId', $memberId)->first();

        $UAC = $user->userAccount;
        if(count($UAC) > 0) {
            $recordTransaction = Transaction::join('user_account', 'transaction.accountId', '=', 'user_account.accountId')
                ->join('users', 'user_account.memberId', '=', 'users.memberId')
                ->where('user_account.memberId', $memberId)
                ->whereDate('users.joinDate', '<=', now()->toDateString())
                ->whereDate('transaction.transactionDate', '>=', now()->toDateString())
                ->get();

            echo count($recordTransaction);
        } else {
            echo "error hee";
        }

    }

    public function storeSimpananDeposit(Request $request) {
        $request['nominal'] = str_replace(',', '', $request->input('nominal'));

        $validator = Validator::make(
            [
                'kind' => $request->input('kind'),
                'memberId' => $request->input('memberId'),
                'nominal' => $request->input('nominal'),
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'kind' => 'required|not_in:-- Pilih Simpanan --|in:wajib,sukarela',
                'memberId' => 'required',
                'nominal' => 'required|numeric|min:50000',
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'kind.required' => 'Jenis simpanan belum dipilih',
                'kind.not_in' => 'Jenis simpanan belum dipilih',
                'kind.in' => 'Jenis simpanan tidak valid',
                'memberId.required' => 'Anggota belum dipilih',
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal simpanan adalah Rp 50,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            //find user account data
            // $checkUAC = DB::table('user_account as uac')
            //     ->select(DB::raw('uac.*'))
            //     ->where('memberId', $input['memberId'])
            //     ->where('kind', $input['kind'])
            //     ->get()->first();

            $user = User::with(['userAccount' => function ($query) {
                $query->where('kind', 'wajib');
            }])->where('memberId', $input['memberId'])->first();
            
            $checkUAC = $user->userAccount;
            if($checkUAC) {
                //check transaction (prevent duplicate transaction for simpanan wajib in a month)
                $month = date('m');
                $year = date('Y');

                $recordTransaction = Transaction::where('accountId', $checkUAC->first()->accountId)
                    ->whereYear('transactionDate', $year)
                    ->whereMonth('transactionDate', $month)
                    ->get();
                
                if(count($recordTransaction) > 0) {
                    return redirect('/admin/simpanan/setoran')->with('warning', 'Simpanan wajib untuk '.$checkUAC->first()->user->fname.' '.$checkUAC->first()->user->lname.' untuk bulan ini sudah dibayar, data gagal disimpan!');
                } else {
                    $buktiSimpanan = "";
                    if($imageSimpanan = $request->file('image')) {
                        $destinationPath = 'image/upload/'.$input['memberId'].'/'.'simpanan/'.$input['kind'].'/';
                        File::makeDirectory($destinationPath, 0777, true, true);

                        $imageName = $input['memberId']."_".time().Str::random(5).$imageSimpanan->getClientOriginalExtension();
                        $buktiSimpanan = $destinationPath.$imageName;
                    }

                    //insert into transaction
                    DB::beginTransaction();
                    $arrTransaction = [];
                    $arrTransaction["accountId"] = $checkUAC->accountId;
                    $arrTransaction["kind"] = $input['kind'];
                    $arrTransaction["total"] = $input['nominal'];
                    $arrTransaction["method"] = $input['method'];
                    $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                    $arrTransaction["image"] = $buktiSimpanan;
                    $arrTransaction["notes"] = $input['notes'];
                    $arrTransaction["status"] = 2;
                    Transaction::create($arrTransaction);

                    if($buktiSimpanan != "") {
                        Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($buktiSimpanan);
                    }

                    //update user account balance
                    $recordUAC = UserAccount::find($checkUAC->accountId);
                    if($recordUAC) {
                        $currentSaldo = $recordUAC->balance + $input['nominal'];
                        $recordUAC->update([
                            'balance' => $currentSaldo,
                        ]);
                    }

                    DB::commit();

                    return redirect('/admin/simpanan/setoran')->withSuccess('Data setoran simpanan berhasil disimpan!');
                }
            } else {
                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $input['memberId'];
                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                $arrUserAccount["kind"] = $input['kind'];
                $arrUserAccount["balance"] = $input['nominal'];
                $arrUserAccount["openDate"] = date('Y-m-d H:i:s');
                UserAccount::create($arrUserAccount);
                //end of insert into user_account

                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$input['memberId'].'/'.'simpanan/'.$input['kind'].'/';
                    File::makeDirectory($destinationPath, 0777, true, true);

                    $imageName = $input['memberId']."_".time().Str::random(5).$imageSimpanan->getClientOriginalExtension();
                    $buktiSimpanan = $destinationPath.$imageName;
                }

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $arrUserAccount["accountId"];
                $arrTransaction["kind"] = $input['kind'];
                $arrTransaction["total"] = $input['nominal'];
                $arrTransaction["method"] = $input['method'];
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                if($buktiSimpanan != "") {
                    $arrTransaction["image"] = $buktiSimpanan;
                }
                $arrTransaction["notes"] = $input['notes'];
                $arrTransaction["status"] = 2;
                Transaction::create($arrTransaction);
                //end of insert into transaction

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                return redirect('/admin/simpanan/setoran')->withSuccess('Data setoran simpanan berhasil disimpan!');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
