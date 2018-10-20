<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request){
        
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
                return redirect('/');
            }         
        }else{
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/');
            } 
        }

        return $this->sendFailedLoginResponse($request);        
    }
    
}
