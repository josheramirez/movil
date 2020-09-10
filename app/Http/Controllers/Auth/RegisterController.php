<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

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
    protected $redirectTo = '/home';
    protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin';
        }
        return '/home';
    }

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request){

        $validatedData = $request->validate(
            [
                'nombre' => 'required',
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'nombre.required' => 'Este campo es obligatorio!',
                'email.required' => 'Este campo es obligatorio!',
                'password.required' => 'Este campo es obligatorio!',
            ]
        );
        $this->create($request->all());
    }
    protected function create(array $data)
    {
        //dd($data,'sssss');
        return User::create([
            'name' => $data['nombre'],
            'email' => $data['email'],
            'login' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
