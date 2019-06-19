<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Compra;
use App\Model\Pagamento;
// use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use App\User;
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
        // $compra = Compra::create('livro' =>, 'data' => , 'valor' =>);
        // DB::table('user_has_compra')->insert(array('user_iduser' => , 'compra_idcompra' => , 'compra_livro_idlivro' =>));
        // return ['status' => true];
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
    public function finaliza(Request $request)
    {
        $compra = Compra::whereIn('idcompra',$request->compra)->with(['users','livro','pagamento'])->where('compra.realizado', 0)->get();
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
        $d= $request->input('validade-cartao').'-01 00:00:00';
        $p = Pagamento::create(['nCartao' => $request->input('numero-cartao'), 'vcc'  => '"'.$request->input('vcc'), 'formaPagamento'  => $request->input('forma-pagamento'), 'dataValidade'  => $d]);
        $compra = Compra::whereIn('idcompra',$request->compra) ->update(['realizado' => 1, 'pagamento_idpagamento' => $p->idpagamento, 'data' => now()]);
        $c = Compra::whereIn('idcompra',$request->compra)->with(['livro','pagamento'])->get();
        $u= User::where('iduser', Auth::user()->iduser)->get();
        $p = PessoaFisica::where("user_iduser",  Auth::user()->iduser)->get();
        $uu= (new PessoaFisicaController)->show($p[0]->idpessoaFisica);
        // dd($uu);
        // return new Email($c,$uu);
        Mail::to(Auth::user())->send(new Email($c,$uu));
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
