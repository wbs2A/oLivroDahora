<?php

namespace App\Http\Controllers;

use App\Model\Cidade;
use App\Model\Endereco;
use App\Model\Estado;
use App\Model\Pagamento;
use App\Model\PessoaFisica;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PessoaFisicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
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
     * @return array
     */
    public function show($cpf)
    {
        $pf = PessoaFisica::find($cpf);
        $user = User::find($pf->user_iduser);
        $endereco = Endereco::find($pf->Endereco_idEndereco);
        $cidade = Cidade::find($endereco->Cidade_idCidade);
        $estado = Estado::find($cidade->Estado_idEstado);
        return array("pf_info"=>$pf, "user_info"=>$user, "endereco_info"=>$endereco, "cidade_info"=>$cidade, "estado_info"=>$estado);
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

    public function getPessoaSessao(){
        $p = PessoaFisica::where('user_iduser', Auth::user()->iduser)->get();
        return $p[0]->idpessoaFisica;

    }

    
    public function updateDados(Request $request, $cpf, $interno = null){
        $userFisico = PessoaFisica::find($cpf);
        $user = User::find($userFisico->user_iduser);
        $userFisico->sexo = $request->sexo;
        $userFisico->dataNascimento = $request->dataNascimento;
        $userFisico->rg = $request->rg;
        $user->name = $request->nome;
        $user->telefone = $request->telefone;
        $userFisico->save();
        $user->save();
        if ($interno == null) {
            return redirect()->route('perfil');
        }else{
            return ['status'=> true];
        }
    }
    public function alteraEndereco(Request $request, $id, $interno = null){
        $data = $request->all();
        $data['idEndereco']=$id;
        $endereco = Endereco::alterar($data);
        if ($interno == null) {
            return redirect()->route('perfil');
        }else{
            return ['status'=> true];
        }
    }
}
