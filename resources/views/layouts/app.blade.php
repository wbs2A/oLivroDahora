<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>O Livro Dahora</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset("css/linearicons.css")}}" />
    <link rel="stylesheet" href="{{asset("css/font-awesome.min.css")}}" />
    <link rel="stylesheet" href="{{asset("css/magnific-popup.css")}}" />
    <link rel="stylesheet" href="{{asset("css/nice-select.css")}}" />
    <link rel="stylesheet" href="{{asset("css/owl.carousel.css")}}" />
    <link rel="stylesheet" href="{{asset("css/bootstrap.css")}}" />
    <link rel="stylesheet" href="{{asset("css/bootstrap-datepicker.css")}}" />
    <link rel="stylesheet" href="{{asset("css/themify-icons.css")}}" />
    <link rel="stylesheet" href="{{asset("css/main.css")}}" />
    <link rel="stylesheet" href="{{asset("css/app.css")}}" />
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
</head>
<body>
    <header class="header-area sticky-top">
        <nav class="navbar navbar-expand-xlg text-center m-4">
            <div class="container justify-content-center">
                <div class="header-wrap">
                    <div
                            class="header-top d-flex justify-content-between align-items-lg-center navbar-expand-lg"
                    >
                        <div class="col-5 text-lg-center mt-2 mt-lg-0">
                          <span class="logo-outer">
                            <span class="logo-inner">
                              <a href="/"
                              style="font-size: 30px; color: black; font-weight: bold;"> oLivro<span style="color: #007cffb5;">Dahora</span> </a>
                            </span>
                          </span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <div id="app">
        <div id="carrinho" class="container">
            <div class="row">
                <div class="card col  m-1">
                            <div class="card-header head ">Dados Pessoais </div>
                           <div class="card-body cardbody">
                               <ul>
                                    <li><b>nome:</b>  {{$user['user_info']['name']}}</li>
                                    <li><b>telefone:</b>{{$user['user_info']['telefone']}}</li>
                                    <li><b>RG:</b> {{$user['pf_info']['rg']}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card col  m-1">
                            <div class="card-header head">Endereço </div>
                            <div class="card-body cardbody">
                                <ul>
                                    <li><b>Rua: </b>{{$user['endereco_info']['rua'] }}</li>
                                    <li><b>Bairro: </b>{{$user['endereco_info']['bairro'] }}</li>
                                    <li><b>Número: </b>{{$user['endereco_info']['numero']}}</li>
                                    <li><b>CEP: </b>{{$user['endereco_info']['cep'] }}</li>
                                    <li><b>Cidade: </b>{{$user['cidade_info']['nome']}}</li>
                                    <li><b>Estado: </b>{{$user['estado_info']['nome']}}</li>
                                </ul>
                            </div>
                        </div>
            </div>
            <table  class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Data</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Valor</th>
                        <th> {{$identificador}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($compra as $c)
                        <tr>
                            <td>
                                {{$c->pagamento->idpagamento}} 
                            </td>
                            <td>{{Carbon\Carbon::parse($c->data)->format('d/m/Y')}}</td>
                            <td>{{($c->livro()->get())[0]->nome}}</td>
                            <td>{{($c->livro()->get())[0]->descricao}}</td>
                            <td> R$ {{($c->livro()->get())[0]->valor}}</td>
                            <td>
                                <ul>
                                    <li><b>nome:</b>{{$c->livro->name}}</li>
                                    <li><b>Email:</b> {{$c->livro->email}}</li>
                                    <li><b>Valor:</b>R$ {{$c->livro->valor}}</li>
                                </ul>
                            </td>
                            @php
                                $total = $total+ ($c->livro()->get())[0]->valor;
                            @endphp
                        </tr>
                    @endforeach 
                    @if($identificador == 'Vendedor')
                        <tr>
                            <td scope="col">
                                Total
                            </td>
                            <td colspan="5">R$ {{$total}}</td>

                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            crossorigin="anonymous"
    ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{asset("js/owl.carousel.min.js")}}"></script>
    <script src="{{asset("js/jquery.sticky.js")}}"></script>
    <script src="{{asset("js/jquery.tabs.min.js")}}"></script>
    <script src="{{asset("js/parallax.min.js")}}"></script>
    <script src="{{asset("js/jquery.nice-select.min.js")}}"></script>
    <script src="{{asset("js/jquery.ajaxchimp.min.js")}}"></script>
    <script src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
    <script src="{{asset("js/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("js/jquery.mask.js")}}"></script>

    <script src="{{asset("js/app.js")}}"></script>

    <script
            type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"
    ></script>
    <script src="{{asset("js/main.js")}}"></script>
    <script type="text/javascript" src="{{asset("js/carrinho.js")}}"></script>
</body>
</html>