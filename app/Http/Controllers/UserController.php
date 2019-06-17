<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\PessoaFisica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Model\Imagens;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perfil');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teste=PessoaFisica::find($id);
        if ($teste) {
            $t=['resposta'=>'Usuário já existe'];
            return $t;
        }else{
            return null;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getTipo(){
        return Auth::user()->tipo;
    }
    public function getUserLogado(){
        if (Auth::check()) {
            return User::where('iduser',Auth::user()->iduser)->with(['pessoaFisica.imagem'])->first();
        }else{
            return null;        
        }
    }
    public function getIdPessoa(){
        $user = PessoaFisica::where('user_iduser', '=', Auth::user()->iduser)->first();
        return $user['idpessoaFisica'];
    }
    public function alteraEmailSenha(Request $request, $id){
        $data = $request->all();
        $user = User::find($id);
        $validacao = Validator::make($data, [
            'email' => 'required|email|max:191',
            'password' => 'required|min:6',
        ]);
        if($validacao->fails())
        {
            return back()->with('errors', $validacao->errors());
        }
        $user->email=$data['email'];
        $user->password= Hash::make($data['password']);
        $user->save();
        return redirect()->route('perfil');
    }
    
    public function postimagem(Request $request){
        $this->validate($request, [
//            'file' => 'image|max:3000'
        ]);
        $file = Input::file('imagem');
        // $filename = $file->getClientOriginalName();
        $path = Storage::disk('public')->putFile('', $request->file('imagem'));
        if($path) {
            $input['filename'] = $path;
            $input['mime'] = $file->getClientMimeType();
            $input['path'] = storage_path();
            $input['size'] = $file->getClientSize();
            $file = Imagens::create($input);
            return response()->json([
                'success' => true,
                'id' => $file->idimagens
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
    }
    public function deleteimagem($id){
        $imagem=Imagens::where('idimagens',$id)->first();
        // dd($imagem);
        if(Storage::disk('public')->delete($imagem->filename)) {
            Imagens::where('idimagens',$id)->delete();
            return response()->json([
                'success' => true
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
    }
    // public function updateimagem($id, Request $request){
    //     $imagem=Imagens::where('idimagens',$id)->first();
    //     $file = Input::file('imagem');
    //     $path = Storage::disk('public')->putFile('', $request->file('imagem'));
    //     if(Storage::disk('public')->delete($imagem->filename)) {
    //         $imagem->filename = $path;
    //         $imagem->mime = $file->getClientMimeType();
    //         $imagem->path = storage_path();
    //         $imagem->size = $file->getClientSize();
    //         $imagem->save();
    //         return response()->json([
    //             'success' => true
    //         ], 200);
    //     }
    //     return response()->json([
    //         'success' => false
    //     ], 500);
    // }
}
