<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Core\Repositories\Contracts\UserRepositoryContract ;

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


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userRes;

    public function __construct(UserRepositoryContract $userRes)
    {
        $this->userRes = $userRes;
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        dd($this->userRes->all());
        return view('login');
    }
}
