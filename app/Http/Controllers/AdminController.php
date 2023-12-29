<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

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
            $user = User::where('status', 2)->get();
            return view('admin.simpanan-deposit-create', compact('user'));
        } elseif ($parameter == "add.simpanan.withdrawal") {
            return view('admin.kredit');
        }
    }

    public function storeSimpananDeposit() {
        $request['nominal'] = str_replace(',', '', $request->input('nominal'));

        $validator = Validator::make(
            [
                'kind' => $request->input('kind'),
                'nominal' => $request->input('nominal'),
                'method' => $request->input('method'),
                'image' => $request->file('image'),
            ],
            [
                'kind' => 'required|not_in:-- Pilih Simpanan --|in:Simpanan Wajib,Simpanan Sukarela',
                'nominal' => 'required|numeric|min:50000',
                'method' => 'required|in:cash,transfer',
                'image' => 'required_if:method,transfer',
            ],
            [
                'kind.required' => 'Jenis simpanan belum dipilih',
                'kind.not_in' => 'Jenis simpanan belum dipilih',
                'kind.in' => 'Jenis simpanan tidak valid',
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal simpanan adalah Rp 50,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'image.required_if' => 'Bukti pembayaran belum diisi',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        try {
            $input = $request->all();

            if(strtolower($input['method']) == "cash") {
                $input['method'] = 2;
            } else {
                $input['method'] = 1;
            }

            if(strtolower($input['kind']) == "simpanan wajib") {
                $input['kind'] = 'wajib';
            } else {
                $input['kind'] = 'sukarela';
            }

            //check if user have user_account
            $user = Auth::user();

            $checkUAC = DB::table('user_account as uac')
                ->select(DB::raw('uac.*'))
                ->where('memberId', $user->memberId)
                ->where('kind', $input['kind'])
                ->get()->first();
            
            //find data UAC
            if($checkUAC) {
                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/';
                    File::makeDirectory($destinationPath, 0777, true, true);
                    $fileName = pathinfo($imageSimpanan->getClientOriginalName(), PATHINFO_FILENAME);
                    $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                    $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

                    $buktiSimpanan = $destinationPath.$imageName;
                }

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $checkUAC->accountId;
                $arrTransaction["kind"] = $input['kind'];
                $arrTransaction["total"] = $input['nominal'];
                $arrTransaction["method"] = $input['method'];
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                $arrTransaction["image"] = $buktiSimpanan;
                $arrTransaction["notes"] = $input['notes'];
                $arrTransaction["status"] = 1;
                Transaction::create($arrTransaction);

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                return redirect('/')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
                // return redirect('/simpanan/pengajuan')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
            } else { //user don't have any account
                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $user->memberId;
                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                $arrUserAccount["kind"] = $input['kind'];
                $arrUserAccount["balance"] = 0;
                UserAccount::create($arrUserAccount);
                //end of insert into user_account

                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/';
                    File::makeDirectory($destinationPath, 0777, true, true);
                    $fileName = pathinfo($imageSimpanan->getClientOriginalName(), PATHINFO_FILENAME);
                    $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                    $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

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
                $arrTransaction["status"] = 1;
                Transaction::create($arrTransaction);
                //end of insert into transaction

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                return redirect('/')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
                // return redirect('/simpanan/pengajuan')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
