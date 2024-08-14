<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userRepository = "";

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        // $this->middleware('auth');
    }

    public function loginstore(LoginRequest $request) {

        try {
            $login = $request->credentails;
            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

            $credentials = [
                $field => $login,
                'password' => $request->input('password'),
            ];

            $auth = Auth::attempt($credentials);

            if ($auth) {
                return redirect('dashboard')->with('success', 'You Have Successfully Logged in.');
            } else {
                return redirect()->back()->with('fail', 'You have entered an invalid email/phone or password.');
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
