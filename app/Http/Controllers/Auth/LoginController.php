<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Jobs\GenerateRecommendations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function authenticated(Request $request, User $user)
    {
        //have to pass in last login before user is updated else 
        //will give incorrect result due to being added to a queue
        //that might process data at a later stime
        GenerateRecommendations::dispatch($user, $user->last_login);
    }
}
