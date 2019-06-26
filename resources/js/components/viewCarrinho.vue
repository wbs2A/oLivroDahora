<template>
	<div> 
		<form v-if="compra.length > 0" method="POST" :action="url">		
			<div v-if="checked" class="row">
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
				<fieldset class="col">
					<div class="row" v-if="user">
				        <div class="card col  m-1">
				            <div class="card-header head ">Dados Pessoais <button v-if="!fim" type="button" class="btn btn-info edit" data-toggle="modal" data-target="#updateDados">
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
				            <div class="card-header head">Endereço <button v-if="!fim" type="button" class="btn btn-info edit" data-toggle="modal" data-target="#updateEndereco">
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
					    <div class="modal fade" id="updateDados" tabindex="-1" role="dialog" aria-labelledby="dadosLabel" aria-hidden="true">
					        <div class="modal-dialog modal-dialog-centered" role="document">
					            <div class="modal-content">
					                <div class="modal-header">
					                    <h5 class="modal-title" id="dadosLabel">Atualizar dados pessoais</h5>
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                        <span aria-hidden="true">&times;</span>
					                    </button>
					                </div>
					                <div class="modal-body">
					                    <form method="post" :action="'api/updateDadosPessoaisPessoaFisica/'+cpf+'/interno'" id="formDados">
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
					                    <button type="button" class="btn btn-success" @click="submitItem($event, 'formDados','updateDados')">Atualizar</button>
					                </div>
					            </div>
					        </div>
					    </div>

					    <div class="modal fade" id="updateEndereco" tabindex="-1" role="dialog" aria-labelledby="enderecoLabel" aria-hidden="true">
					        <div class="modal-dialog modal-dialog-centered" role="document">
					            <div class="modal-content">
					                <div class="modal-header">
					                    <h5 class="modal-title" id="enderecoLabel">Atualizar Endereço</h5>
					                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                        <span aria-hidden="true">&times;</span>
					                    </button>
					                </div>
					                <div class="modal-body">
					         	        <form method="post" :action="'api/updateDadosPessoaisEndereco/'+user.endereco_info.idEndereco+'/interno'" id="formDadosEndereco">
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
					                    <button type="button" class="btn btn-success" @click="submitItem($event, 'formDadosEndereco','updateEndereco')">Atualizar</button>
					                </div>
					            </div>
					        </div>
					    </div>
				    </div>
		            
				</fieldset>
				<fieldset v-if="!fim" class="col-3">
					<legend>Cartão de crédito</legend>
					<div class="col">
					    <div class="row mb-3">
				            <label for="numero-cartao">Número</label>
					        <input type="number" class="form-control" id="numero-cartao" name="numero-cartao" required>
					    </div>
					    <div class="row mb-3">
				            <label for="forma-pagamento">Forma de Pagamento</label>
				            <select class="form-control" id="forma-pagamento" name="forma-pagamento" required>
				            	<option>Débito</option>
      							<option>Credito</option>
				            	
				            </select>
					    </div>
					    <div class="row mb-3">
						    <label for="vcc">VCC</label>
						    <input type="number" class="form-control" id="vcc" name="vcc" placeholder="" required>
					    </div>
					    <div class="row mb-3">
					        <label for="validade-cartao">Validade</label>
					        <input type="month" class="form-control" id="validade-cartao" name="validade-cartao" required>
					    </div>
					</div>
				</fieldset>
			</div>

			<table  class='table table-striped table-bordered'>
				<thead>
			        <tr>
				        <th scope="col"></th>
				        <th scope="col">Nome</th>
				        <th scope="col">Descrição</th>
				        <th scope="col">Valor</th>
				   		<!-- <th v-if="!fim" scope="col">Frete <br>produto</th> -->
				   		<th scope="col">Subtotal(Valor + Frete)</th>
				        <th v-if="!fim" scope="col">Remover <br>produto</th>
			        </tr>
			    </thead>
			    <tbody>
				    <tr v-for="(c,key) in carrinho">
				    	<td>
				    		<input v-if="!checked" type="checkbox" @click="teste" name="compra[]" :id="'compra'+key" :value="c.idcompra">
				    		<input v-else type="hidden" @click="teste" name="compra[]" :id="'compra'+key" :value="c.idcompra">
				    	</td>
				        <td>{{c.livro.nome}}</td>
				        <td>{{c.livro.descricao}}</td>
				        <td> R$ {{c.livro.valor}}</td>
				        <td >
					    	<!-- <select v-bind:change="frete">
								<option value="04014">SEDEX à vista</option>
								<option value="04065">SEDEX à vista pagamento na entrega</option>
								<option value="04510">PAC à vista</option>
								<option value="04707">PAC à vista pagamento na entrega</option>
								<option value="40169">SEDEX 12 ( à vista e a faturar)</option>
								<option value="40215">SEDEX 10 (à vista e a faturar)</option>
								<option value="40290">SEDEX Hoje Varejo</option>
					    	</select> -->
					    	Preço minimo : R$ {{ soma(t,c.livro.valor)}}					    	
					    </td>
					    <!-- <td v-if="!fim">
					    	
					    </td> -->
					    <td v-if="!fim">
					    	<a  v-bind:href="'api/carrinho/'+ c.idcompra" class="btn btn-danger">X</a>
					    	
					    </td>
				    </tr>
				    <tr>
				    	<td scope="col">
				    		Subtotal
				    	</td>
				        <td colspan="5" v-if="!fim">R$ {{total}}</td>
				        <td colspan="4" v-else>R$ {{total}}</td>

				    </tr>
				    <tr>
				    	<td scope="col">
				    		Total(Frete+Subtotal)
				    	</td>
				        <td colspan="5" v-if="!fim">R$ {{soma(t,total)}}</td>
				        <td colspan="4" v-else>R$ {{soma(t,total)}}</td>

				    </tr>
				</tbody>
			</table>
			<input type="hidden" name="_token" :value="token">
			<button class="form-control"   id="submit" v-if="!checked" disabled type="submit">Finalizar compra</button>

			<button class="form-control"   id="submit" v-if="checked && !fim" type="submit">Finalizar compra</button>
		</form>
		<p v-else >Você não possui itens no carrinho</p>

	</div>
</template>
<script>
	import axios from 'axios';
    import moment from 'moment';
    import Vue2Filters from 'vue2-filters';
    import VeeValidate from 'vee-validate' ;
     import BuscaCep from '../components/buscacep.vue';
    axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    };
    Vue.use(Vue2Filters);
    Vue.use(VeeValidate);

    Vue.config.productionTip = false;

    Vue.filter('formatDate', function(value) {
        if (value) {
            return moment(String(value)).format('MM/DD/YYYY')
        }
    });

    Vue.filter('formatCep', function(value) {
        if (value) {
            value = value.slice(0,5)+'-'+value.slice(5); 
            console.log(value);
            return value;
        }
    });
    Vue.filter('formatTelefone', function(value) {
        if (value) {
            value = "("+value;
            value =  [value.slice(0,3),")", value.slice(3)].join('');
            return [value.slice(0,9),"-", value.slice(9)].join('');
        }
    });
    export default{
        props: ['carrinho', 'checked','url', 'fim'],
        components:{
            buscacep : BuscaCep,

        },
        data() {
		   return {
		        loading: true,
                user: null,
                error: null,
                cpf: '',
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
			    compra: this.carrinho,			   
			    t:10.00,
			    v:true,
                error: null,
			    token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
		   }
	   },
        computed:{
        	total: function(t) {
        		var sum = 0;
                this.compra.forEach(e => {
                    sum += e.livro.valor;
                });
                return sum;
		    }
	    },
        created() {
            this.fetchData();
        },
        methods: {
        	soma(t,value){
				return t+value;
			},
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
            deleteCompra: function (id){
		        console.log(id);
		        axios.delete('api/carrinho/'+id).then(
		           res => {
		            console.log(res.data);
		            if (res.data.status) {
		            	axios.get('api/carrinho').then(
		           			res => {
		           				if (res.data.status) {
		           					this.compra= res.data.compra;
		           				}
		           			},
		           			(error) => {
		            			console.log(error);
		        			});
		            }
		           },
		           (error) => {
		            console.log(error);
		        });
		    },
            submitItem(evt, formid, modal){
                evt.preventDefault();
                // document.getElementById(formid).submit();
                var myForm = document.getElementById(formid);
                var action=document.getElementById(formid).action
				var formData = new FormData(myForm);
				axios.post(action,
					formData,
					{
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                    ).then(
                    res => {
		            console.log(res.data);
		            if (res.data.status) {
		            	console.log('#'+modal);
		            	$('#'+modal).modal('hide');
		            	$( ".modal-backdrop" ).remove();
		            	this.fetchData();
		            }
		           },
		           (error) => {
		            console.log(error);
		        });	
            },
            formatDate(data, formato) {
                if (formato == 'pt-br') {
                    return (data.substr(0, 10).split('-').reverse().join('/'));
                } else {
                    return (data.substr(0, 10).split('/').reverse().join('-'));
                }
            },
		    teste : function () {
		    	var c=0;
		    	$('input[type="checkbox"]').each(function(){
		    		if (this.checked) {
		    			c+=1;
		    		}
		    	});
		    	if (c) {
		    		$('#submit').removeAttr('disabled');
		    	}else{
		    		$('#submit').attr('disabled','disabled');
		    	}
		    },
		    frete: function(e){
		    	console.log(e.target.value);
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