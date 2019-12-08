<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return View('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        // \Debugbar::addMessage($email, 'email');
        // \Debugbar::addMessage($password, 'Password');

        $validatedData = $request->validate([
            'email' => 'required|regex:/^.+@.+\..+$/i',
            'password' => 'required',
        ]);

        // \Debugbar::addMessage($validatedData, 'Validated Data');

        $userTable = \DB::select('select id from user where email = :email', ['email' => $email]);

        if (sizeof($userTable) == 0) {
            //Email does not exist
            // \Debugbar::addMessage('Unsuccessful: Email does not exist', 'Login State');
            return '?error=emailNotFound';
        }

        $userTable = \DB::select('select id from user where email = :email AND password = :password', ['email' => $email, 'password' => $password]);
        // \Debugbar::addMessage($userTable, 'userTable');

        if (sizeof($userTable) > 0) {
            //Successful login
            // \Debugbar::addMessage('Successful', 'Login State');
            return '/';
        } else {
            //Incorrect password
            // \Debugbar::addMessage('Unsuccessful', 'Login State');
            return '?error=incorrectPassword';
        }
    }
}
