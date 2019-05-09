<template>
    <div>
        <div class="loading center" v-if="loading" >
            <div class="swapping-squares-spinner"> 
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
            </div>
        </div>

        <div v-if="error" class="error">
            <h1>{{ error }}</h1>
        </div>
        <div class="col" v-if="user">
            <div class="row">
                <div class="card col  m-1">
                    <div class="card-header head ">Dados Pessoais <button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#updateDados" data-backdrop="static" data-keyboard="false">
                        <i class="fas fa-edit"></i> Editar dados
                    </button></div>
                    <div class="card-body cardbody">
                        <ul>
                            <li><b>nome:</b>  {{user.user_info.name}}</li>
                            <li><b>sexo:</b> {{user.pf_info.sexo}}</li>
                            <li><b>telefone:</b>{{user.user_info.telefone | formatTelefone}}</li>
                            <li><b>RG:</b> {{user.pf_info.rg}}</li>
                            <li><b>Data de Nascimento:</b> {{user.pf_info.dataNascimento | formatDate}}</li>
                        </ul>
                    </div>
                </div>
                <div class="card col  m-1">
                    <div class="card-header head">Endereço <button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#updateEndereco">
                        <i class="fas fa-edit"></i> Editar dados
                    </button></div>
                    <div class="card-body cardbody">
                        <ul>
                            <li><b>Rua: </b>{{user['endereco_info']['rua'] | capitalize}}</li>
                            <li><b>Bairro: </b>{{user['endereco_info']['bairro'] | capitalize}}</li>
                            <li><b>Número: </b>{{user['endereco_info']['numero']}}</li>
                            <li><b>CEP: </b>{{user['endereco_info']['cep'] | formatCep}}</li>
                            <li><b>Cidade: </b>{{user['cidade_info']['nome']}}</li>
                            <li><b>Estado: </b>{{user['estado_info']['nome']}}</li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="card row m-1">
                <div class="card-header head">Dados de acesso à conta <button type="button" class="btn btn-info edit" data-toggle="modal" data-target="#updateConta">
                    <i class="fas fa-edit"></i> Editar dados
                </button></div>
                <div class="card-body cardbody">
                    <ul>
                        <li><b>e-mail:</b> {{user['user_info']['email']}}</li>
                        <li><b>Senha:</b> *********</li>
                    </ul>
                </div>
            </div>

            <div class="modal fade" id="updateDados" tabindex="-1" role="dialog" aria-labelledby="dadosLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dadosLabel">Atualizar dados pessoais</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" :action="'api/updateDadosPessoaisPessoaFisica/'+cpf" id="formDados">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="form-group row">
                                    <div class="form-group col">
                                        <label for="nome"> Nome</label>
                                        <input type="text" class="form-control text-body" id="nome" name="nome" v-model="user.user_info.name" required/>
                                    </div>
                                    <div class="form-group col">
                                        <label for="sexo"> Sexo</label>
                                        <input type="text" class="form-control text-body" id="sexo" name="sexo" v-model="user.pf_info.sexo" required/>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="telefone"> Telefone</label>
                                    <input type="text" class="form-control text-body" id="telefone" name="telefone" v-model="user.user_info.telefone" required/>
                                </div>
                                <div class="form-group col">
                                    <label for="rg"> RG</label>
                                    <input type="text" class="form-control text-body" id="rg" name="rg" v-model="user.pf_info.rg" required/>
                                </div>
                                <div class="form-group col">
                                    <label for="dataNascimento"> Data de Nascimento</label>
                                    <input type="date" class="form-control text-body" id="dataNascimento" name="dataNascimento" v-model="user.pf_info.dataNascimento" required/>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-success" @click="submitItem($event, 'formDados')">Atualizar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateEndereco" tabindex="-1" role="dialog" aria-labelledby="enderecoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="enderecoLabel">Atualizar Endereço</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" :action="'api/updateDadosPessoaisEndereco/'+user.endereco_info.idEndereco" id="formDadosEndereco">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="form-group row">
                                    <buscacep :cep="user.endereco_info.cep"></buscacep>
                                  <div class="col mb-3">
                                    <label for="numero" class="col-form-label text-md-right">Numero</label>
                                    <input type="number" class="form-control" id="numero" name="numero" placeholder="" v-model="user.endereco_info.numero">
                                    <small id="numroHelp" class="form-text text-muted">Por favor, insira apenas numeros.</small>
                                  </div>
                                  </div>

                                  <div class="form-group row">
                                  <div class="col-4 mb-3">
                                    <label for="bairro" class="col-form-label text-md-right">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="" v-model="user.endereco_info.bairro">
                                  </div>
                                  <div class="col-4 mb-3">
                                    <label for="rua" class="col-form-label text-md-right">Rua</label>
                                    <input type="text" class="form-control" id="rua" name="rua" placeholder="" v-model="user.endereco_info.rua">
                                  </div>
                                    
                                  </div>
                                  
                                  <div class="form-group row">
                                  <div class="col-6 mb-3">
                                    <label for="estado" class="col-form-label text-md-right">Estado</label>
                                    <input type="text" class="form-control" id="estado" name="estado" placeholder="" v-model="user.estado_info.nome">
                                    <small id="estadoHelp" class="form-text text-muted">Por favor, insira o nome completo.</small>
                                  </div>
                                  <div class="col-6 mb-3">
                                    <label for="cidade" class="col-form-label text-md-right">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" placeholder="" v-model="user.cidade_info.nome">
                                    <small id="cidadeHelp" class="form-text text-muted">Por favor, insira o nome completo.</small>
                                  </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-success" @click="submitItem($event, 'formDadosEndereco')">Atualizar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateConta" tabindex="-1" role="dialog" aria-labelledby="contaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contaLabel">Atualizar dados da Conta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" :action="'api/updateDadosPessoaisUser/'+user.user_info.iduser" id="formUser">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="form-group input-group">
                                    <div class="col">
                                        <label for="email"> E-mail</label>
                                        <input type="email" class="form-control text-body" id="email" name="email" v-model="user.user_info.email" required/>
                                    </div>

                                    <div class="input-fields row">
                                        <div class="form-group col">
                                            <label for="senha"> Senha</label>
                                            <input type="password" v-validate="'required'" class="form-control" id="senha" ref="password" name="password" required placeholder="Insira sua nova senha"/>
                                        </div>
                                        <div class="form-group col">
                                            <label for="confirmarsenha">Confirmar Senha</label>
                                            <input type="password"  v-validate="'required|confirmed:password'" class="form-control" id="confirmarsenha" name="password_confirmation" data-vv-as="password"  placeholder="Insira a senha novamente"  required/>
                                        </div>
                                    </div>
                                    <!-- ERRORS -->
                                    <div class="alert alert-danger" v-show="errors.any()">
                                        <div class="col" v-if="errors.has('password')">
                                            O campo de senha é obrigatório!
                                        </div>
                                        <div class="col" v-if="errors.has('password_confirmation')">
                                            As senhas não coincidem.
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-success" @click="submitItem($event, 'formUser')">Atualizar</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    import BuscaCep from '../components/buscacep.vue';
    export default {
        name: "FisicaHome",
        components:{
            buscacep : BuscaCep,

        },
        data() {
            return {
                loading: true,
                user: null,
                error: null,
                cpf: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            };
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.error = this.user = null;
                this.loading = true;
                axios
                .get('/api/getIdFisica/').then(res=> {
                        this.cpf = res.data;
                        console.log(this.cpf);
                        axios.get('/api/getPFisica/' + res.data)
                            .then(
                                response => {
                                    this.loading = false;
                                    this.user = response.data;
                                },
                                (error) => {
                                    console.log(error);
                                    this.error = error;
                                    this.loading = false;
                                }
                            )
                    },
                    (error) => {
                        this.error = error;
                        this.loading = false;
                });
            },
            submitItem(evt, formid){
                evt.preventDefault();
                document.getElementById(formid).submit();
            },
            formatDate(data, formato) {
                if (formato == 'pt-br') {
                    return (data.substr(0, 10).split('-').reverse().join('/'));
                } else {
                    return (data.substr(0, 10).split('/').reverse().join('-'));
                }
            }
        }
    }
</script>

<style scoped="">
    .center {
        margin: auto;
        width: 50%;
        padding: 100px;
        padding-left: 20%;
    }

    .edit{
        position: relative;
        float: right;
    }
    .swapping-squares-spinner, .swapping-squares-spinner * {
        box-sizing: border-box;
    }

    .swapping-squares-spinner {
        height: 65px;
        width: 65px;
        position: relative;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    }

    .swapping-squares-spinner .square {
        height: calc(150px * 0.25 / 1.3);
        width:  calc(150px * 0.25 / 1.3);
        animation-duration: 1000ms;
        border: calc(65px * 0.04 / 1.3) solid #000000;
        margin-right: auto;
        margin-left: auto;
        position: absolute;
        animation-iteration-count: infinite;
    }

    .swapping-squares-spinner .square:nth-child(1) {
        animation-name: swapping-squares-animation-child-1;
        animation-delay: 500ms;
    }

    .swapping-squares-spinner .square:nth-child(2) {
        animation-name: swapping-squares-animation-child-2;
        animation-delay: 0ms;
    }

    .swapping-squares-spinner .square:nth-child(3) {
        animation-name: swapping-squares-animation-child-3;
        animation-delay: 500ms;
    }

    .swapping-squares-spinner .square:nth-child(4) {
        animation-name: swapping-squares-animation-child-4;
        animation-delay: 0ms;
    }

    @keyframes swapping-squares-animation-child-1 {
        50% {
            transform: translate(150%,150%) scale(2,2);
        }
    }

    @keyframes swapping-squares-animation-child-2 {
        50% {
            transform: translate(-150%,150%) scale(2,2);
        }
    }

    @keyframes swapping-squares-animation-child-3 {
        50% {
            transform: translate(-150%,-150%) scale(2,2);
        }
    }

    @keyframes swapping-squares-animation-child-4 {
        50% {
            transform: translate(150%,-150%) scale(2,2);
        }
    }
    button{
        color: #eee;
    }
    .head{
        font-size: 25px;
    }
    .cardbody{
        font-size: 17px;

    }
    b{
        color: #0b0b0b;
    }
</style>