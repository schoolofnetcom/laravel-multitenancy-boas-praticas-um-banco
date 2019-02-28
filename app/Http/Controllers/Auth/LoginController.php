<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $sectionConfig = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sectionConfig = \Section::get('login');
        $guard = $this->sectionConfig['guard'];
        $this->middleware("guest:$guard")->except('logout');
        $this->redirectTo = $this->sectionConfig['redirect_login'];
    }

    public function showLoginForm()
    {
        return view($this->sectionConfig['show_login_form']);
    }

    protected function loggedOut(Request $request)
    {
        return redirect($this->sectionConfig['logged_out']);
    }

    protected function guard()
    {
        return \Auth::guard($this->sectionConfig['guard']);
    }
}
