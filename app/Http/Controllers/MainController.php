<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
        $request->validate([
            'kind' => ['required', 'not_in:-- Pilih Simpanan --'],
            'nominal' => 'required',
            'method' => 'required'
        ]);

        try {
            $input = $request->all();

            $input['nominal'] = str_replace(',', '', $input['nominal']);

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
            $checkUAC = UserAccount::where('memberId', $user->memberId)
            ->where('kind', $input['kind'])
            ->first();
            
            //find data UAC
            if($checkUAC) {
                if ($checkUAC->openDate === null) { //update data

                } else { //new data
                    //insert into user_account
                    $arrUserAccount = [];
                    $arrUserAccount["memberId"] = $user->memberId;
                    //generate acount id
                    $salt_1 = random_int(0, 9);
                    $salt_2 = Str::random(7);
                    $salt_3 = Str::random(16);
                    $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                    $arrUserAccount["kind"] = $input['kind'];
                    $arrUserAccount["balance"] = $input['nominal'];
                    UserAccount::create($arrUserAccount);
                    //end of insert into user_account

                    $butkiSimpanan = "";
                    if($imageSimpanan = $request->file('image')) {
                        $destinationPath = 'image/upload/'.$user->memberId.'/';
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
                    $arrTransaction["image"] = $buktiSimpanan;
                    $arrTransaction["notes"] = $input['notes'];
                    $arrTransaction["status"] = 1;
                    Transaction::create($arrTransaction);

                    if($buktiSimpanan != "") {
                        Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($input['image']);
                    }
                    //end of insert into transaction
                }
            } else { //new data
                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $user->memberId;
                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);
                $arrUserAccount["kind"] = $input['kind'];
                $arrUserAccount["balance"] = $input['nominal'];
                UserAccount::create($arrUserAccount);
                //end of insert into user_account

                $buktiSimpanan = "";
                if($imageSimpanan = $request->file('image')) {
                    $destinationPath = 'image/upload/'.$user->memberId.'/';
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

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(1024, 768, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }
                //end of insert into transaction
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
