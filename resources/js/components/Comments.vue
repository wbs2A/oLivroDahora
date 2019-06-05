<template>
	<div class="container-fluid">
		<div class="comments-app">
		   <h1>Comentario</h1>
		   <!-- From -->
		   <div class="comment-form p-1" v-if="user">
			   <!-- Comment Avatar -->
			   <form class="form" name="form">
				   <div class="form-row m-3">
					   <div class="comment-avatar col-1" v-if="user.pessoa_fisica.imagem">
						   <img class="rounded col p-0 m-0" :src="'/storage/'+user.pessoa_fisica.imagem.filename">
					   </div>
						<div class="comment-avatar p-2" v-else>
						   <i class="fa fa-user icon" style="font-size: 20px;" aria-hidden="true"></i>
					   </div>
					   <input class="input col form-control" type="text" disabled :value="user.name">
				   </div>
				   <div class="form-row m-3">
						<update-imagem ref="modal" v-on:submit="setImagem" :cla="'fa fa-file-image-o'" :size="'20'" :url="'/api/comentario/imagem'"></update-imagem>
					   <textarea class="input form-control icon" placeholder="Add comment..." required v-model="message"></textarea>
					   <span class="input" v-if="errorComment" style="color:red">{{errorComment}}</span>
				   </div>
				   <div class="form-row m-3">
					   <input type="button" class="btn btn-success" @click="saveComment" value="Add Comment">
				   </div>
			   </form>
		   </div>
		   <div class="comment-form p-1" v-else>
			   <!-- Comment Avatar -->
			   <span>É necessário fazer login para comentar</span>
		   </div>
		   <!-- Comments List -->
		   <div class="comments" v-if="comments" v-for="(comment,index) in commentsData">
			   <!-- Comment -->
			   <div class="comment">
				   <!-- Comment Box -->
				   <div class="comment-box comment-form p-3" >
					   <!-- Comment Avatar -->
					   <div v-if="comment.photo_url" class="comment-avatar col-1">
						   <img class="rounded col p-0 m-0" :src="'/storage/'+comment.photo_url.filename">
					   </div>
						<div v-else class="comment-avatar">
						   <i class="fa fa-user icon" style="font-size: 20px;" aria-hidden="true"></i>
					   </div>
					   <!-- <button v-if="user.iduser == comment.iduser" class="bnt btn-info" @click="openeditComentario('/api/comentario/'+comment.commentid, comment)"					   >Editar</button> -->
					   <button v-if="user.iduser == comment.iduser || user.iduser == comment.idpostuser" class="bnt btn-danger" @click="opendeleteComentario('/api/comentario/'+comment.commentid)">Exluir</button>
					   <div class="comment-text m-1">
							<p v-if="comment.comment">
								{{comment.comment}}
							</p>
							<img v-if="comment.imagem" class="col-10" :src="'/storage/' + comment.imagem.filename">
						</div>
					   <div class="comment-footer">
						   <div class="comment-info row">
								<div class="col-9">
								   <span class="comment-author">
										   <em>{{ comment.name}}</em>
									   </span>
								   <span class="comment-date">{{ comment.date}}</span>
								</div>
								<div class="col-1 ml-auto">
									<a class="" v-if="user" v-on:click="openComment(index)">Reply</a>
								</div>
						   </div>
					   </div>
				   </div>
				   <!-- From -->
				   <div class="comment-form p-1 col-10 ml-auto comment-v" v-if="commentBoxs[index]">
					   <!-- Comment Avatar -->
					   <form class="form" name="form">
					   		<div class="form-row m-3">
							   <div class="comment-avatar col-1" v-if="user.pessoa_fisica.imagem">
								   <img class="rounded col p-0 m-0" :src="'/storage/'+user.pessoa_fisica.imagem.filename">
							   </div>
								<div class="comment-avatar p-2" v-else>
								   <i class="fa fa-user icon" style="font-size: 20px;" aria-hidden="true"></i>
							   </div>
							   <input class="input col form-control" type="text" disabled :value="user.name">
						   </div>
						   <div class="form-row m-3">
								<update-imagem ref="reply" v-on:submit="setReplyImagem" :cla="'fa fa-file-image-o'" :size="'18'" :url="'/api/comentario/imagem'"></update-imagem>
								<textarea class="input form-control icon" placeholder="Add comment..." required v-model="message"></textarea>
							   <span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
						   </div>
						   <div class="form-row m-3">
							   <input type="button" class="btn btn-success" v-on:click="replyComment(comment.commentid,index)" value="Add Replay">
						   </div>
					   </form>
				   </div>
				   <!-- Comment - Reply -->
				   	<div v-if="comment.reply" class="col-1 ml-auto">
						<a class=""  v-on:click="openCommentConts(index)">Continuar</a>
					</div>
				   <div v-if="commentRepliesBoxs[index]" class="m-3" v-for="(replies,index2) in comment.replies">
					   <div class="comments" >
						   	<div  class="comment comment-form m-0 p-3 pb-0 reply ml-2" style="background: grey;">
								<!-- Comment Avatar -->
								<div v-if="replies.photo_url" class="comment-avatar col-1">
									<img class="rounded col p-0 m-0" :src="'/storage/'+replies.photo_url.filename">
								</div>
								<div v-else class="comment-avatar">
								   <i class="fa fa-user icon" style="font-size: 20px;" aria-hidden="true"></i>
								</div>
								<!-- Comment Box -->
								<button v-if="user.iduser == comment.iduser || user.iduser == replies.idpostuser" class="bnt btn-danger" @click="opendeleteComentario('/api/comentario/'+replies.commentid)">Exluir</button>
								<div class=" comment-form m-0 p-0" style="background: grey;">
									<div class="comment-text" style="color: white">
										<p v-if="replies.comment">{{replies.comment}}</p>
										<img v-if="replies.imagem" class="col-10" :src="'/storage/' + replies.imagem.filename">
									</div>
									<div class="comment-footer">
										<div class="comment-info">
											<div class="col-9">
												<span class="comment-author">{{replies.name}}</span>
												<span class="comment-date">{{replies.date}}</span>
											</div>
											<div v-if="user" class="col-1 ml-auto">
												<a v-on:click="replyCommentBox(index2)">Reply</a>
											</div>
										</div>
									</div>
								</div>
								<!-- From -->
								<div class="comment-form p-1 reply" v-if="replyCommentBoxs[index2]">
									<form class="form" name="form">
										<div class="form-row m-3">
										   <div class="comment-avatar col-1" v-if="user.pessoa_fisica.imagem">
											   <img class="rounded col p-0 m-0" :src="'/storage/'+user.pessoa_fisica.imagem.filename">
											</div>
											<div class="comment-avatar p-2" v-else>
											   <i class="fa fa-user icon" style="font-size: 20px;" aria-hidden="true"></i>
											</div>
											<input class="input col form-control" type="text" disabled :value="user.name">
										</div>
										<div class="form-row m-3">
											<update-imagem ref="reply" v-on:submit="setReplyImagem" :cla="'fa fa-file-image-o'" :size="'18'" :url="'/api/comentario/imagem'"></update-imagem>
											<textarea class="input form-control icon" placeholder="Add comment..." required v-model="message"></textarea>
											<span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
										</div>
										<div class="form-row m-3">
										   <input type="button" class="btn btn-success" v-on:click="replyComment(replies.commentid,index2, index)" value="Add Comment">
										</div>
									</form>
								</div>
							</div>			
					   </div>
					</div>
				   
			   </div>
		   </div>
		   <div class="modal fade" id="Mensagem" tabindex="-1" role="dialog" aria-labelledby="contaLabelMensagem" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contaLabelMensagem"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span id="conteudoMensagem"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button  class="btn btn-success" data-ref="" @click="deleteComentario()" id="sim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="contaLabelEdit" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contaLabelEdit"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        	<update-imagem ref="update" :src="imagem" v-on:update="update":cla="'fa fa-file-image-o'" :size="'18'" :url="'/api/comentario/imagem'"></update-imagem>
							<textarea class="input form-control icon" placeholder="Add comment..." required v-model="message2"></textarea>
							<span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
                            <span id="conteudoEdit"></span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button  class="btn btn-success" data-ref="" @click="editComentario()" id="sim">Sim</button>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>    
</template>
<script>
var _ = require('lodash');
import axios from 'axios';
import updateImagem from './updateImagem.vue';

axios.defaults.headers.common = {
	'X-Requested-With': 'XMLHttpRequest',
	'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

export default {
   props: ['commentUrl','user'],
   components: {
		updateImagem
   },
   data() {
	   return {
		   comments: [],
		   commentreplies: [],
		   comments: 0,
		   commentBoxs: [],
		   message: null,
		   message2: null,
		   id:0,
		   replyId:0,
		   index: 0,
		   tes:null,
		   cr:0,
		   imagem:null,
		   replyCommentBoxs: [],
		   commentsData: [],
		   viewcomment: [],
		   show: [],
		   commentRepliesBoxs: [],
		   errorComment: null,
		   endereco:null,
		   errorReply: null
	   }
   },
   methods: {
	   fetchComments() {
			console.log(this.commentUrl);
			axios.get('/api/comentarios/'+this.commentUrl).then(res => {
				this.commentData = res.data;
				this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
				this.comments = this.commentData.length;
				console.log(res.data);
			});  
	   },
	   openComment(index) {
		   if (this.user) {
			   if (this.commentBoxs[index]) {
				   Vue.set(this.commentBoxs, index, 0);
			   } else {
				   Vue.set(this.commentBoxs, index, 1);
			   }
		   }
	   },
	   openCommentConts(index){
	   		console.log(this.commentRepliesBoxs[index]);
			   if (this.commentRepliesBoxs[index]) {
				   Vue.set(this.commentRepliesBoxs, index, 0);
			   } else {
				   Vue.set(this.commentRepliesBoxs, index, 1);
			   }
	   },
	   replyCommentBox(index) {
		   if (this.user) {
			   if (this.replyCommentBoxs[index]) {
				   Vue.set(this.replyCommentBoxs, index, 0);
			   } else {
				   Vue.set(this.replyCommentBoxs, index, 1);
			   }
		   }
	   },
	   saveComment() {
			if (document.getElementsByClassName('icon')[0].style.display == 'none') {
				this.$refs.modal.submitFiles();
			}else{
			   if (this.message != null && this.message != ' ') {
				   this.errorComment = null;
				   axios.post('/api/comentario', {
					   idpost: this.commentUrl,
					   texto: this.message,
					   user_iduser: this.user.iduser
				   }).then(res => {
						console.log(res.data);
						axios.get('/api/comentarios/'+this.commentUrl).then(res => {
							this.commentData = res.data;
							this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
							this.message = null;
							this.comments = this.commentData.length;
							console.log(res.data);
						});
						console.log(this.commentsData);
						this.comments = this.commentData.length;
				   });
			   } else {
				   this.errorComment = "Por favor, insira um comentario";
			   }
			}
	   },
	   replyComment(commentId, index, index1 = null) {
	   		this.replyId = commentId;
	   		this.index = index;
	   		this.cr =index1;
			if (document.getElementsByClassName('icon')[0].style.display == 'none') {
				var tes=this.$refs.reply[0];
				console.log(this.$refs.reply[0]);
				tes.submitFiles();
			}else{
			   if (this.message != null && this.message != ' ') {
				   this.errorComment = null;
				   axios.post('/api/comentario', {
					   idpost: this.commentUrl,
					   texto: this.message,
					   user_iduser: this.user.iduser,
					   reply_id: this.replyId
				   }).then(res => {
						console.log(res.data);
						if (res.data.status) {
							if (this.cr == null) {
								axios.get('/api/comentario/'+this.replyId+'/'+this.commentUrl).then(res => {
									if (res.data.status) {
										console.log(res.data);
											if (this.commentData[this.index].reply == 0) {
												this.commentData[this.index].reply = 1;
											}
											console.log(this.commentData[this.index]);
											this.commentData[this.index].replies=res.data.comment.replies;	
											this.comments = this.commentData.length;
									   		this.message = null;
											console.log(res.data);
											Vue.set(this.replyCommentBoxs, this.index, 0);
										   	Vue.set(this.commentBoxs, this.index, 0);	
									}
								});
							}else{
								axios.get('/api/comentario/'+this.commentData[this.cr].commentid+'/'+this.commentUrl).then(res => {
									if (res.data.status) {
										if (this.commentData[this.cr].reply == 0) {
											this.commentData[this.cr].reply = 1;
										}
										console.log(this.commentData[this.cr]);
										this.commentData[this.cr].replies=res.data.comment.replies;	
										this.comments = this.commentData.length;
								   		this.message = null;
										console.log(res.data);
										Vue.set(this.replyCommentBoxs, this.index, 0);
									   	Vue.set(this.commentBoxs, this.index, 0);
									}
								});
							}	
						}
				   });
			   } else {
				   this.errorReply = "Por favor, insira um comentario";
			   }
			}
	   },
	   setImagem(resposta){
			console.log('resposta');
			console.log(resposta.id);
			this.id = resposta.id;
			console.log(this.id);
			console.log(this.user.iduser);
			axios.post('/api/comentario', {
				idpost: this.commentUrl,
				imagens_idimagens: this.id,
				user_iduser: this.user.iduser
			}).then(res => {
				console.log(res.data);
				if (res.data.status) {
					axios.get('/api/comentarios/'+this.commentUrl).then(res => {
						this.commentData = res.data;
						this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
						this.comments = this.commentData.length;
						this.$refs.modal.removeFile(0);
						console.log(res.data);
						Vue.set(this.replyCommentBoxs, this.index, 0);
						Vue.set(this.commentBoxs, this.index, 0);	
					});
				}
				console.log(this.commentsData);
			});
	   },
	   setReplyImagem(resposta){
	   		console.log('resposta');
			console.log(resposta.id);
			this.id = resposta.id;
			console.log(this.id);
			axios.post('/api/comentario', {
				idpost: this.commentUrl,
				imagens_idimagens: this.id,
				user_iduser: this.user.iduser,
				reply_id: this.replyId
			}).then(res => {
				console.log(res.data);
						if (res.data.status) {
							if (this.cr == null) {
								axios.get('/api/comentario/'+this.replyId+'/'+this.commentUrl).then(res => {
									if (res.data.status) {
										console.log(res.data);
											if (this.commentData[this.index].reply == 0) {
												this.commentData[this.index].reply = 1;
											}
											console.log(this.commentData[this.index]);
											this.commentData[this.index].replies=res.data.comment.replies;
											this.comments = this.commentData.length;
									   		this.tes=this.$refs.reply[0];
											this.tes.removeFile(0);
											this.tes=null;
											this.index=0;
											this.id=0;
											this.replyId=0;
											console.log(res.data);
											Vue.set(this.replyCommentBoxs, this.index, 0);
										   	Vue.set(this.commentBoxs, this.index, 0);	
									}
								});
							}else{
								axios.get('/api/comentario/'+this.commentData[this.cr].commentid+'/'+this.commentUrl).then(res => {
									if (res.data.status) {
										if (this.commentData[this.cr].reply == 0) {
											this.commentData[this.cr].reply = 1;
										}
										console.log(this.commentData[this.cr]);
										this.commentData[this.cr].replies=res.data.comment.replies;	
										this.comments = this.commentData.length;
								   		this.tes=this.$refs.reply[0];
										this.tes.removeFile(0);
										this.tes=null;
										this.index=0;
										this.id=0;
										this.replyId=0;
										console.log(res.data);
										Vue.set(this.replyCommentBoxs, this.index, 0);
									   	Vue.set(this.commentBoxs, this.index, 0);
									}
								});
							}	
						}
			});
	   },
	    opendeleteComentario(string){
	    	console.log(string);
	        $('#contaLabelMensagem').text('Excluir comentario');
	        $('#conteudoMensagem').text('Deseja, realmente, excluir este comentario?');
	        $('#sim').attr('data-ref', string);
	        $('#Mensagem').modal('show');
	    },
	    deleteComentario(){
	    	var string;
	    	string = $('#sim').attr('data-ref');
	    	console.log(string);
	        axios.delete(string).then(res => {
	        	console.log(res.data);
	        	if (res.data.status) {
					$('#Mensagem').modal('hide');
		        	axios.get('/api/comentarios/'+this.commentUrl).then(res => {
						this.commentData = res.data;
						this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
						this.comments = this.commentData.length;
						console.log(res.data);
					});
	        	}
	        });
	    },
	    openeditComentario(string, comentario){
	    	console.log(string);
	    	console.log(comentario);
	        $('#contaLabelEdit').text('Editar comentario');
	    	if (comentario.idimagem == null) {
	    		this.message2=comentario.comment;
	    	}else{
	    		console.log(comentario.imagem);
	    		this.imagem=comentario.imagem;
	    		this.$refs.update.setupdate();
	    	}
	        // $('#conteudoEdit').text('Deseja, realmente, excluir este comentario?');
	        $('#sim').attr('data-ref', string);
	        $('#Edit').modal('show');
	    },
	    editComentario(){
	    	var string;
	    	string = $('#sim').attr('data-ref');
	    	console.log(string);
	    	if (document.getElementsByClassName('icon')[0].style.display == 'none') {
				this.$refs.modal.submitFiles();
			}else{
			   if (this.message2 != null && this.message2 != ' ') {
				   this.errorComment = null;
			        axios.put(string,{
			        	texto: this.message2
			        }).then(res => {
			        	console.log(res.data);
			        	if (res.data.status) {
							$('#Edit').modal('hide');
				        	axios.get('/api/comentarios/'+this.commentUrl).then(res => {
								this.commentData = res.data;
								this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
								this.comments = this.commentData.length;
								console.log(res.data);
							});
			        	}
			        });
			    }else{
			    	this.errorComment = "Por favor, insira um comentario";
			    }
			}
	    },
	    update(resposta){

	    }
	},
   mounted() {
		console.log("mounted");
		this.fetchComments();
   }
}
</script>