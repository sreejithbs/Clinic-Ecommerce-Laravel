<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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
    // protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:clinic')->except('logout');
    }

    /**
     * COMMON : Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * COMMON : Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function handleLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->get('remember'))) {
            return redirect()->intended('/admin/dashboard');

        } elseif (Auth::guard('clinic')->attempt($request->only('email', 'password'), $request->get('remember'))) {
            if (Auth::guard('clinic')->status == 'suspend') {
                Auth::logout($request);
                return redirect()->back()->withInput($request->only('email', 'remember'))
                        ->withErrors(['error' => 'Your Clinic account has been suspended. Please contact Site Administrator.']);
            }
            return redirect()->intended('/clinic/dashboard');
        }

        // } elseif (Auth::attempt($request->only('email', 'password'), $request->get('remember'))) {
        //     return redirect()->intended('/user/dashboard');
        // }

        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out of the application - Override logout() method
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('home');
    }

}