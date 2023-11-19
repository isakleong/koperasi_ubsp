<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('main.index', compact(['user']));
    }

    public function addSimpanan() {
        $user = Auth::user();

        return view('main.saving-add', compact(['user']));
    }

    public function addTabungan() {
        $user = Auth::user();

        return view('main.saving-add', compact(['user']));
    }

    public function addCredit() {
        $user = Auth::user();

        return view('main.credit-add', compact(['user']));
    }

    public function addAngsuran() {
        $user = Auth::user();

        return view('main.credit-angsuran-add', compact(['user']));
    }

    public function recapSaving() {
        $user = Auth::user();

        return view('main.saving-recap', compact(['user']));
    }

    public function recapCredit() {
        $user = Auth::user();

        return view('main.credit-recap', compact(['user']));
    }

    public function recapAngsuran() {
        $user = Auth::user();

        return view('main.credit-angsuran-recap', compact(['user']));
    }

    public function showEditProfile(Request $request) {
        $user = Auth::user();

        return view('main.profile-edit', compact(['user']));
    }

    public function showEditPassword(Request $request) {
        $user = Auth::user();

        return view('main.password-edit', compact(['user']));
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
