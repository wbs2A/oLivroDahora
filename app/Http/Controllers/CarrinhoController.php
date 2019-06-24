<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Compra;
use App\Model\Pagamento;
use App\Model\Post;
// use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\User;
use App\Model\Livro;
use App\Model\PessoaFisica;
use App\Http\Controllers\PessoaFisicaController;

class CarrinhoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        // dd($request->all());
        $id = Auth::user()->iduser;
        $c =Compra::where('livro_idlivro' , $request->input('livro_idlivro'))->with(['users' => function($q) use($id){
            $q->where('user_iduser', '=', $id); // '=' is optional
        }])->get();
        if (count($c) > 0) {
            return ['status' => false];
        }
        $compra = Compra::create($request->all());
        DB::table('user_has_compra')->insert(array('user_iduser' => $id , 'compra_idcompra' => $compra->idcompra, 'compra_livro_idlivro' => $request->input('livro_idlivro')));
        return ['status' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = Auth::user()->iduser;
        $compra = Compra::with(['users','livro','pagamento'])->whereHas('users', function($q) use($id) {
       // Query the name field in status table
               $q->where('user_iduser', '=', $id); // '=' is optional
        })->where('compra.realizado', 0)->get();
        return ['status'=> true, 'compra' => $compra];
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
        Compra::where('idcompra', $id)->delete();

        return redirect()->route('carrinho');
    }
    public function frete(Request $request)
    {
        dd($request);
    }
    public function finaliza(Request $request)
    {
        $compra = Compra::whereIn('idcompra',$request->compra)->with(['users','livro','pagamento'])->where('compra.realizado', 0)->get();
        // $i=0;
        // while ($i < count($compra)) {

        //     $compra[$i]->frete = 2;
        //     $i=$i+1;
        // }
        return view('finalizar', ['compra' => $compra]);
    }
    public function compra(Request $request)
    {
        $this->validate($request, [
           'compra' => 'required',
           'validade-cartao' => 'required',
           'forma-pagamento' => 'required',
           'vcc' => 'required',
           'numero-cartao' => 'required',
       ]);
        $iduser= Auth::user()->iduser;
        $d= $request->input('validade-cartao').'-01 00:00:00';
        $cl=Compra::find($request->compra);
        $usersV=array();
        $v;
        foreach ($cl as $value) {
            $p = Pagamento::create(['nCartao' => $request->input('numero-cartao'), 'vcc'  => $request->input('vcc'), 'formaPagamento'  => $request->input('forma-pagamento'), 'dataValidade'  => $d]);
            $compra = Compra::where('idcompra',$value->idcompra)->update(['realizado' => 1, 'pagamento_idpagamento' => $p->idpagamento, 'data' => now()]);
            
            $l=Livro::where('idlivro', $value->livro_idlivro)->update(['comprado' => 1]);
            DB::table('post_has_livro')->where('livro_id', '=', $value->livro_idlivro)->delete();
            // falta retirar de qualquer carrinho os livros vendidos
            Compra::where([['idcompra','<>',$value->idcompra], ['livro_idlivro', $value->livro_idlivro]])->delete();
        }
        $c = Compra::whereIn('idcompra',$request->compra)->with(['livro' => function($q){
             $q->join('user_has_compra','livro.idlivro', 'user_has_compra.compra_livro_idlivro')->join('user', 'user_iduser','iduser')->join("pessoafisica","pessoafisica.user_iduser","user.iduser")->join('endereco','pessoafisica.Endereco_idEndereco', 'endereco.idEndereco')->select("*");
             //  $q->join('user_has_compra','livro.idlivro', 'user_has_compra.compra_livro_idlivro')->join('user', 'user_iduser','iduser')->join("Pessoafisica","pessoafisica.user_iduser","user.iduser")->join('endereco','pessoafisica.Endereco_idEndereco', 'endereco.idEndereco')->join('cidade', 'endereco.Cidade_idCidade', 'cidade.idCidade')->join('estado', 'cidade.Estado_idEstado', 'estado.idEstado')->select("*","estado.nome as estado","cidade.nome as cidade");
        },'pagamento'])->get();
        // dd();
        $p = PessoaFisica::where("user_iduser",  Auth::user()->iduser)->get();
        $uu= (new PessoaFisicaController)->show($p[0]->idpessoaFisica);
        foreach ($c as $value) {
            $cs = Compra::where('idcompra',$value->idcompra)->with(['livro' => function ($q) 
            {
                $q->join('user_has_compra','livro.idlivro', 'user_has_compra.compra_livro_idlivro')->join('user', 'user_iduser','iduser')->join('pessoafisica','iduser', 'pessoafisica.user_iduser')->join('endereco','pessoafisica.Endereco_idEndereco', 'endereco.idEndereco')->join('cidade', 'endereco.Cidade_idCidade', 'cidade.idCidade')->join('estado', 'cidade.Estado_idEstado', 'estado.idEstado')->select("*","estado.nome as estado","cidade.nome as cidade");
            },'pagamento'])->get();
            // dd($value);
            $pv = PessoaFisica::where("user_iduser",  $value->livro->iduser)->get();
            $uuv= (new PessoaFisicaController)->show($pv[0]->idpessoaFisica);
            // return new Email($cs,$uuv,'Cliente');
            Mail::to(User::where('iduser', $value->livro->iduser)->first())->send(new Email($cs,$uuv,'Cliente'));
        }
        // return new Email($c,$uu,'Vendedor');
        Mail::to(Auth::user())->send(new Email($c,$uu,'Vendedor'));
        return view('compra', ['compra' => $c]);
    }
    // public function generatePDF(Request $request){
        
    //     $data = ['empresa' => 'LocadoraDAHORA'];
    //     // Pagamento::
    //     Compra::whereIn('idcompra',$request->compra)->with(['users','livro','pagamento'])->where('compra.realizado', 0)->get();//set update toDo

    //     $pdf = PDF::setOptions(['images' => true, 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('myPDF', $data);

    //     return $pdf->download('voucher.pdf');
    // }
}
