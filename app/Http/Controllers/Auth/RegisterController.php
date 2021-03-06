<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use App\Model\PessoaFisica;
use App\Model\Endereco;
use Validator;

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
    // protected $redirectTo = '/';
    protected function redirectTo(){
        return  route('home');
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
        $validate;
        $data['telefone']=preg_replace("/[^0-9]/", "", $data['telefone']);
        $data['cep']=preg_replace("/[^0-9]/", "", $data['cep']);
        $data['cpf']=preg_replace("/[^0-9]/", "", $data['cpf']);
        $data['rg']=preg_replace("/[^0-9]/", "", $data['rg']);
        $validate = Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => 'max:45|unique:email',
            'telefone'=>'required',
            'idpessoaFisica' => 'cpf|unique:pessoafisica',
            'password' => 'min:6|required|confirmed',
            'password_confirmation' => 'same:password|required_with:password',
            'email' => 'max:45',
            'nascimento'=>'required',
            'sexo'=>'required',
            'cep'=>'required',
            'numero'=>'required',
            'cidade'=>'required',
            'bairro'=>'required',
            'rua'=>'required',
            'estado'=>'required'
        ]);
        return $validate;
    }
     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $data = $request->all();
        // dd($request);
        $data['telefone']=preg_replace("/[^0-9]/", "", $data['telefone']);
        $data['cep']=preg_replace("/[^0-9]/", "", $data['cep']);
        $data['cpf']=preg_replace("/[^0-9]/", "", $data['cpf']);
        $data['rg']=preg_replace("/[^0-9]/", "", $data['rg']);
        $tipo = 0;
        $user=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telefone'=> $data['telefone'],
            'tipo' => $tipo,
            'password' => Hash::make($data['password'])
        ]);
        $data['user']=$user->iduser;
        $endereco=Endereco::inserir($request, $data);
        $data['endereco']=$endereco->idEndereco;
        if (!empty($request->file('imagem'))) {
            $data['imagem'] = $this->insertImagem($request);
        }
        $pessoa = PessoaFisica::inserir($data);
        $data['pessoa']=$pessoa->idpessoaFisica;
        return $user;
    }
}
