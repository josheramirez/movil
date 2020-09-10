<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $input = $request->all();

        $validatedData = $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Este campo es obligatorio!',
                'password.required' => 'Este campo es obligatorio!',
            ]
        );
// dd(Auth::user());
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if (auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password']))) {
            $user = Auth::user();
            if($user->user_type=='1'){
                return redirect()->route('trabajador');
            }
            if($user->user_type=='2'){
                return redirect()->route('administrador');
            }
            return redirect()->route('trabajador');
        } else {
            return redirect()->route('login')
                ->with('error', 'Las credenciales no coinciden con los resgistros en la base de datos!');
        }
    }
}
