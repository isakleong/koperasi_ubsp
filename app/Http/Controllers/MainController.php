<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

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

        if ($parameter == "add-simpanan") {
            return view('main.simpanan-add', compact(['user']));
        } elseif ($parameter == "recap-simpanan") {
            return view('main.simpanan-recap', compact(['user']));
        } elseif ($parameter == "add-tabungan") {
            return view('main.tabungan-add', compact(['user']));
        } elseif ($parameter == "recap-tabungan") {
            return view('main.tabungan-recap', compact(['user']));
        } elseif ($parameter == "add-kredit") {
            return view('main.kredit-add', compact(['user']));
        } elseif ($parameter == "add-angsuran") {
            return view('main.angsuran-add', compact(['user']));
        } elseif ($parameter == "recap-kredit") {
            return view('main.kredit-recap', compact(['user']));
        } elseif ($parameter == "recap-angsuran") {
            return view('main.angsuran-recap', compact(['user']));
        } elseif ($parameter == "edit-profile") {
            return view('main.profile-edit', compact(['user']));
        } elseif ($parameter == "edit-password") {
            return view('main.password-edit', compact(['user']));
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
