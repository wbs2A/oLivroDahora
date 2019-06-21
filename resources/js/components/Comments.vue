<template>
	<div class="container-fluid">
		<div class="comments-app">
		   <h1>Comentario</h1>
		   <!-- From -->
		   <div class="comment-form p-1" v-if="user">
			   <!-- Comment Avatar -->
			   <form class="form" id="saveComment" name="form">
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
				   			<update-imagem ref="modal" :cla="'fa fa-file-image-o icon'" :size="'20'" :url="'/api/comentario/imagem'"></update-imagem>
					   <textarea :class="'m-0 input form-control icon'" placeholder="Add comment..." required v-model="message"></textarea>
					   <span class="input" v-if="errorComment" style="color:red">{{errorComment}}</span>
				   </div>
				   <div class="form-row m-3">
					   <input type="button" class="btn btn-success" @click="saveComment('saveComment')" value="Add Comment">
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
					   <button v-if="user.iduser == comment.iduser" class="bnt btn-info" @click="openeditComentario('/api/ucomentario/'+comment.commentid, comment)"					   >Editar</button>
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
					   <form class="form" name="form" id="replyComment">
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
								<update-imagem ref="reply" :cla="'fa fa-file-image-o icon'+comment.commentid" :size="'18'" :url="'/api/comentario/imagem'"></update-imagem>
								<textarea :class="'input form-control icon'+comment.commentid" placeholder="Add comment..." required v-model="message"></textarea>
							   <span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
						   </div>
						   <div class="form-row m-3">
							   <input type="button" class="btn btn-success" v-on:click="replyComment(comment.commentid,index,'replyComment')" value="Add Replay">
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
									<form class="form" id="replyReplyComment" name="form">
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
											<update-imagem ref="reply" :cla="'fa fa-file-image-o icon'+replies.commentid" :size="'18'" :url="'/api/comentario/imagem'"></update-imagem>
											<textarea :class="'input form-control icon'+replies.commentid" placeholder="Add comment..." required v-model="message"></textarea>
											<span class="input" v-if="errorReply" style="color:red">{{errorReply}}</span>
										</div>
										<div class="form-row m-3">
										   <input type="button" class="btn btn-success" v-on:click="replyComment(replies.commentid,index2, 'replyReplyComment', index)" value="Add Comment">
										</div>
									</form>
								</div>
							</div>			
					   </div>
					</div>
				   
			   </div>
		   </div>
		   <div class="modal fade" id="Mensagem" tabindex="-1" role="dialog" aria-labelledby="contaLabelMensagem" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
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
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contaLabelEdit"></h5>
                            <button @click="closeEdit" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        	<form class="form" id="editComment" name="form">
	                        	<update-imagem ref="update" :src="imagem" :cla="'fa fa-file-image-o iconEdit'" :size="'18'" :url="'/api/comentario/imagem'"></update-imagem>
								<textarea class="input form-control iconEdit" placeholder="Add comment..." required v-model="message2"></textarea>
								<span class="input" v-if="errorReply" style="color:red">{{errorEdit}}</span>
	                            <span id="conteudoEdit"></span>
	                        </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" @click="closeEdit" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button  class="btn btn-success" data-ref="" @click="editComentario('editComment')" id="sim">Sim</button>
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
		   myurl:null,
		   cr:0,
		   imagem:null,
		   replyCommentBoxs: [],
		   commentsData: [],
		   viewcomment: [],
		   show: [],
		   commentRepliesBoxs: [],
		   errorComment: null,
		   errorEdit: null,
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
	   saveComment(formid) {
			    if (this.message != null && this.message != ' ' || document.getElementsByClassName('icon')[0].style.display == 'none') {
				    this.errorComment = null;
				    var myForm = document.getElementById(formid);
					var formData = new FormData(myForm);
					if (this.message != null && this.message != ' ' && document.getElementsByClassName('iconEdit')[0].style.display != 'none') {
						formData.append('texto', this.message);	
					}
					formData.append('idpost', this.commentUrl);
					formData.append('user_iduser', this.user.iduser);
					axios.post('/api/comentario', 
						formData,
						{
	                        headers: {
	                            'Content-Type': 'multipart/form-data'
	                        }
	                    }
				   	).then(res => {
						console.log(res.data);
						axios.get('/api/comentarios/'+this.commentUrl).then(res => {
							this.commentData = res.data;
							this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
							this.message = null;
							this.comments = this.commentData.length;
							if (document.getElementsByClassName('icon')[0].style.display == 'none') {
								this.$refs.modal.removeFile(0);
							}
							console.log(res.data);
						});
						console.log(this.commentsData);
						this.comments = this.commentData.length;
				   });
			    } else {
				    this.errorComment = "Por favor, insira um comentario";
			    }
	   },
	   replyComment(commentId, index, formid,index1 = null) {
	   		this.replyId = commentId;
	   		this.index = index;
	   		this.cr =index1;
			if (this.message != null && this.message != ' ' || document.getElementsByClassName('icon')[0].style.display == 'none') {
				this.errorComment = null;
				var myForm = document.getElementById(formid);
				var formData = new FormData(myForm);
				if (this.message != null && this.message != ' ' && document.getElementsByClassName('iconEdit')[0].style.display != 'none') {
					formData.append('texto', this.message);	
				}
				formData.append('idpost', this.commentUrl);
				formData.append('user_iduser', this.user.iduser);
				formData.append('reply_id', this.replyId);
				axios.post('/api/comentario', 
					formData,
					{
	                    headers: {
	                        'Content-Type': 'multipart/form-data'
	                    }
	                }
				).then(res => {
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
							console.log(this.commentData);
							console.log(this.cr);
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
	    	this.imagem=comentario;
	    	this.myurl=string;
	    	console.log(string);
	    	console.log(comentario);
	        $('#contaLabelEdit').text('Editar comentario');
	    	if (comentario.idimagem == null) {
	    		this.message2=comentario.comment;
	    	}
	    		console.log(comentario.imagem);
	    		// console.log(this.$refs.update);
	    		// this.$refs.update.setupdate();
	        // $('#conteudoEdit').text('Deseja, realmente, excluir este comentario?');
	        $('#sim').attr('data-ref', string);
	        $('#Edit').modal('show');
	    },
	    editComentario(formid){
	    	var string;
	    	string = $('#sim').attr('data-ref');
	    	console.log(string);
	    	if (this.message2 != null && this.message2 != ' ' || document.getElementsByClassName('iconEdit')[0].style.display == 'none') {
			    this.errorEdit = null;
			    var myForm = document.getElementById(formid);
				var formData = new FormData(myForm);
				if (this.message2 != null && this.message2 != ' ' && document.getElementsByClassName('iconEdit')[0].style.display != 'none') {
					formData.append('texto', this.message2);	
				}
			    axios.post(string,
					formData,
					{
	                    headers: {
	                        'Content-Type': 'multipart/form-data'
	                    }
	                }
				).then(res => {
				   	console.log(res.data);
				   	if (res.data.status) {
				       	axios.get('/api/comentarios/'+this.commentUrl).then(res => {
							this.commentData = res.data;
							this.commentsData = _.orderBy(res.data, ['date'], ['desc']);
							this.comments = this.commentData.length;
							console.log(res.data);
							this.closeEdit();
							$('#Edit').modal('hide');
						});
				    }
			    });
			}else{
			    this.errorEdit = "Por favor, insira um comentario";
			}
	    },
	    closeEdit(){
			this.message2='';
			this.$refs.update.removeFile();
			this.imagem=null;

	    }
	},
   mounted() {
		console.log("mounted");
		this.fetchComments();
   }
}
</script>