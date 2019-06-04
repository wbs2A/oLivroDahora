<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Avaliacao;
use App\Model\PostHasAvaliacao;

class AvaliacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $this->validate($request, [
       'quantidade' => 'required',
       'idpost' => 'required',
       'user_iduser' => 'required',
       ]);

        $avaliacao = Avaliacao::create($request->except('idpost'));
        PostHasAvaliacao::create(['post_idpost' => $request->input('idpost'), 'avaliacao_idavaliacao' => $avaliacao->idavaliacao, 'iduser' =>$request->input('user_iduser')]);
        return ['status' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $av =Avaliacao::find($id);
        $av->quantidade = $request->input('quantidade');
        $av->save();
        return ['status' => true];
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
}
