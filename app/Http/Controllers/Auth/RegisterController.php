<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $table = 'candidatos';

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:candidatos'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'apellidos' => [ 'string', 'max:255'],
            'direccion' => [ 'string', 'max:255'],
            'dni' => [ 'string', 'max:9', 'unique:candidatos'],
            'localidad' => [ 'string', 'max:255'],
            'provincia' => [ 'string', 'max:255'],
            'pais' => [ 'string', 'max:50'],
            'cp' =>  ['integer', 'max:5'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'apellidos' => '',
            'direccion' => '',
            'email' => $data['email'],
            'dni' => '',
            'localidad' => '',
            'provincia' => '',
            'imagen' => '',
            'pais' => '',
            'cp' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }
}
