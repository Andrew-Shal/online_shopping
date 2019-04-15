<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Enums\AccountStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number."];
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cust_country' => ['required', 'string', 'max:255'],
            'cust_city' => ['required', 'string', 'max:255'],
            'cust_street' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'max:30', 'confirmed', 'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $stat = new AccountStatus(AccountStatus::ACTIVE);

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'cust_country' => $data['cust_country'],
            'cust_city' => $data['cust_city'],
            'cust_street' => $data['cust_street'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
