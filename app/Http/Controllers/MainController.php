<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MainController extends Controller
{
    public function test() {
        return view('auth.test');
    }

    public function index() {
        $user = Auth::user();

        return view('main.index', compact(['user']));
    }

    public function showFormData() {
        $user = Auth::user();

        $parameter = Route::currentRouteName();

        if ($parameter == "add.simpanan") {
            return view('main.simpanan-add', compact(['user']));
        } elseif ($parameter == "recap.simpanan") {
            return view('main.simpanan-recap', compact(['user']));
        } elseif ($parameter == "add.tabungan") {
            return view('main.tabungan-add', compact(['user']));
        } elseif ($parameter == "recap.tabungan") {
            return view('main.tabungan-recap', compact(['user']));
        } elseif ($parameter == "add.kredit") {
            return view('main.kredit-add', compact(['user']));
        } elseif ($parameter == "add.angsuran") {
            return view('main.angsuran-add', compact(['user']));
        } elseif ($parameter == "recap.kredit") {
            return view('main.kredit-recap', compact(['user']));
        } elseif ($parameter == "recap.angsuran") {
            return view('main.angsuran-recap', compact(['user']));
        } elseif ($parameter == "edit.profile") {
            return view('main.profile-edit', compact(['user']));
        } elseif ($parameter == "edit.password") {
            return view('main.password-edit', compact(['user']));
        }
    }

    public function storeSimpanan(Request $request) {
        // $request->validate([
        //     'kind' => ['required', 'not_in:-- Pilih Simpanan --', 'in:Simpanan Wajib,Simpanan Sukarela'],
        //     'nominal' => 'required',
        //     'method' => 'required'
        // ]);

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
                'kind.in' => 'Jenis simpanan tidak dikenal',
                'nominal.required' => 'Nominal belum diisi',
                'nominal.min' => 'Minimal nominal simpanan adalah Rp 50,000',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak dikenal',
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

            //ini aneh, jalan, tapi nda bisa dapat accountId ($checkUAC->accountId)
            // $checkUAC = UserAccount::where('memberId', $user->memberId)
            // ->where('kind', $input['kind'])
            // ->get()->first();

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

                return redirect('/simpanan/pengajuan')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
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
                return redirect('/simpanan/pengajuan')->withSuccess('Data pengajuan simpanan berhasil dikirim!');
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function editProfile(Request $request, $id) {
        // Retrieve existing user data
        $user = User::find($id);

        $excludedFields = ['password', 'ktp', 'kk', 'memberId', 'phone', 'email', 'email_verified_at', 'birthdate', 'workAddress'];

        // Compare form data with existing data
        $formData = $request->except($excludedFields);
        $changesDetected = false;

        foreach ($formData as $key => $value) {
            // Check if the form data is different from existing data
            if ($user->{$key} != $value) {
                $changesDetected = true;
                // You can break out of the loop if changes are detected early
                // break;
            }
        }

        // Update data if changes are detected
        if ($changesDetected) {
            dd('there is update');
            // $user->update($formData);
            // Add any additional logic or messages as needed
        } else {
            dd('nope');
            // No changes detected, you may choose to handle this case differently
            // For example, show a message to the user
        }
    }
}
