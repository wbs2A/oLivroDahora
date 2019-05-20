<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    // protected $redirectTo = '/index';

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
        $data = $request->all();
        $validacao = Validator::make($data, [
            'email' => 'required|email|max:191',
            'password' => 'required|min:6',
        ]);

        if($validacao->fails())
        {
            return back()->with('errors', $validacao->errors());
        }
        $remember = $request->input('remember');
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], $remember)){
            return redirect()->route('home');
        }else{
            return back()->with('error', 'Email e/ou Senha invalido(s)');
        }
    }

    public function showLoginForm(Request $request)
    {
        return view('auth/login');
    }

    public function logout(Request $request){
        // session()->remove('user');
        Auth::logout();
        return redirect('home');
    }
    protected function redirectTo(){
        return  route('home');
    }
}
