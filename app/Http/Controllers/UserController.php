<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function loginstore(Request $request) {
        $validator = Validator::make($request->all(), [
            'credentails' => 'required',
            'password' => 'required'
        ],
        [
            'credentails.required' => 'Email or Phone Required',
            'password.required' => 'Password Required'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $login = $request->credentails;
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $field => $login,
            'password' => $request->input('password'),
        ];

        $auth = Auth::attempt($credentials);

        if ($auth) {
            return redirect('dashboard');
        } else {
            return redirect()->back()->with('fail', 'Email or Password is wrong.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
