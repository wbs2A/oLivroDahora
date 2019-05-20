@extends('master')

@section('content')
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Registrar-se</div>

                    <div class="card-body">
                        <form id="register" method="POST" action="{{ route('register') }}">

                            @csrf
                            <div class="form-group row">
                                <div class="col-5">
                                    <label for="name" class="col-form-label text-md-right">Nome Completo</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nome') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-4">
                                    <label for="email" class="col-form-label text-md-right">E-Mail</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="teste@teste.com">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-3">
                                    <label for="telefone" class="col-form-label text-md-right">Telefone</label>
                                    <input id="telefone" type="tel" data-mask="(000) 0000-0000" class="form-control{{ $errors->has('telefone') ? ' is-invalid' : '' }}" value="{{ old('telefone') }}" name="telefone" placeholder="(000) 0000-0000" required>
                                    <small id="telefoneHelp" class="form-text text-muted">Por favor, como ddd do seu estado. Apenas numeros.</small>
                                    @if ($errors->has('telefone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div  class="form-group row">
                                <div class="col fisica" >
                                    @php
                                        if(old('cpf')){
                                            $cpf=old('cpf');
                                            $cpf=preg_replace("/[^0-9]/", "", $cpf);
                                        }
                                    @endphp
                                    @if (old('cpf'))

                                        <buscacpf :cpf="'{{$cpf}}'"></buscacpf>
                                    @else
                                        <buscacpf></buscacpf>
                                    @endif

                                    <small id="cpfHelp" class="form-text text-muted">Por favor, insira apenas numeros.</small>
                                    <span class="invalid-feedback" role="alert" >
                                        <strong id="fisica-cpf"></strong>
                                    </span>
                                </div>

                                <div class=" fisica col-2 p-0 mr-1 ml-1 mb-3" >
                                    <label for="rg" class="col-form-label text-md-right">RG</label>
                                    <input type="text" class="form-control" data-mask="000.000.000" name="rg" id="rg" placeholder="RG" value="{{ old('rg') }}">
                                    <small id="rgHelp" class="form-text text-muted">Por favor, insira apenas numeros.</small>
                                    @if ($errors->has('rg'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('rg') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-3  fisica  p-0 mr-1 ml-1 mb-3" >
                                    <label for="nascimento" class="col-form-label text-md-right" >Data de nascimento</label>
                                    <input type="date" class="form-control" id="nascimento" name="nascimento" placeholder="" value="{{ old('nascimento') }}">
                                    @if ($errors->has('nascimento'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nascimento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-2 fisica  p-0 mr-1 ml-1 mb-3" >
                                    <label for="sexo" class="col-form-label text-md-right" >Sexo</label>
                                    <input type="text" class="form-control" id="sexo" name="sexo" placeholder="" value="{{ old('sexo') }}">
                                    @if ($errors->has('sexo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sexo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-12">Endereço</label>
                                @php
                                    if(old('cep')){
                                        $cep=old('cep');
                                        $cep=preg_replace("/[^0-9]/", "", $cep);
                                    }
                                @endphp
                                @if (old('cep'))
                                    <buscacep :onde="'register'" :cep="'{{$cep}}'"></buscacep>
                                @else
                                    <buscacep :onde="'register'"></buscacep>
                                @endif

                                <div class="col-2 mb-3">
                                    <label for="numero" class="col-form-label text-md-right">Numero</label>
                                    <input type="number" class="form-control" id="numero" name="numero" placeholder="" value="{{ old('numero') }}">
                                    <small id="numroHelp" class="form-text text-muted">Por favor, insira apenas numeros.</small>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="bairro" class="col-form-label text-md-right">Bairro</label>
                                    <input type="text" class="form-control" id="bairroregister" name="bairro" placeholder="" value="{{ old('bairro') }}">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="rua" class="col-form-label text-md-right">Rua</label>
                                    <input type="text" class="form-control" id="ruaregister" name="rua" placeholder="" value="{{ old('rua') }}">
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="estado" class="col-form-label text-md-right">Estado</label>
                                    <input type="text" class="form-control" id="estadoregister" name="estado" placeholder="" value="{{ old('estado') }}">
                                    <small id="estadoHelp" class="form-text text-muted">Por favor, insira o nome completo.</small>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="cidade" class="col-form-label text-md-right">Cidade</label>
                                    <input type="text" class="form-control" id="cidaderegister" name="cidade" placeholder="" value="{{ old('cidade') }}">
                                    <small id="cidadeHelp" class="form-text text-muted">Por favor, insira o nome completo.</small>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-6 mb-3">
                                    <label for="password" class="col-form-label text-md-right">Senha</label>
                                    <input id="password" minlength="6" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                    <small id="passwordHelp" class="form-text text-muted">Por favor, insira uma senha com no minimo 6 caracteres.</small>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="password-confirm" class="col-form-label text-md-right">Confirmar Senha</label>
                                    <input id="password-confirm" minlength="6" type="password" class="form-control" name="password_confirmation" required>
                                    <small id="passwordHelp" class="form-text text-muted">Por favor, insira sua senha novamente.</small>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class=" col-auto btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/register.js"></script>
@endsection