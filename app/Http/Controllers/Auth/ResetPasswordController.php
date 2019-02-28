<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $config = \Section::get('login');
        $guard = $config['guard'];
        $this->middleware("guest:$guard");
        $this->redirectTo = $config['redirect_login'];
    }

    protected function rules()
    {
        $rule = \Section::getSection() == 'admin' ? 'is_admin': 'is_user_tenant';
        return [
            'token' => 'required',
            'email' => "required|email|$rule",
            'password' => 'required|confirmed|min:6',
        ];
    }

    protected function guard()
    {
        return \Auth::guard(\Section::get('login.guard'));
    }
}
