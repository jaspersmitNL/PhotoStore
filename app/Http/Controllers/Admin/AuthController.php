<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    function login() {
        if (session()->has('currentUser')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    function logout(): RedirectResponse {
        session()->remove('currentUser');
        return redirect()->route('admin.login');
    }

    function validateLogin(Request $req) {

        try {
            $req->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where([
                'email' => strtolower($req->email)
            ])->first();

            if ($user) {
                if (Hash::check($req->password, $user->password)) {
                    $req->session()->put('currentUser', $user->id);
                    return redirect()->route('admin.dashboard');
                }
            }


        } catch (Exception $e) {

        }

        return back()->with(['fail' => __("auth.failed")]);
    }


}
