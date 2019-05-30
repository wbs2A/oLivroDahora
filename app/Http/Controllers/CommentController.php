<?php

namespace App\Http\Controllers;

use App\Events\CommentEvent;
use Illuminate\Http\Request;
use App\Model\Comentarios;
use App\Model\PostHasComentarios;
use App\Model\UserHasPost;
use App\User;
use App\Model\PessoaFisica;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\UserController;
class CommentController extends Controller
{
	//
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
   public function store(Request $request){
	   $this->validate($request, [
	   'texto' => 'filled',
	   'reply_id' => 'filled',
	   'imagens_idimagens' => 'filled',
	   'idpost' => 'required',
	   'user_iduser' => 'required',
	   ]);
	   $comment = Comentarios::create($request->except('idpost'));
	   if (empty($request->input('reply_id'))) {
		   PostHasComentarios::create(['post_idpost' => $request->input('idpost'), 'comentarios_idcomentarios' => $comment->idcomentarios, 'comentarios_user_iduser' => $request->input('user_iduser')]);
	   }
	   if($comment){
			return $this->oneComment($comment->idcomentarios, $request->input('idpost'));
		}
   }
   /**
	* Get Comments for pageId
	*
	* @return Comments
	*/
   public function index($id){
	   $comments = Comentarios::with(['posts','imagem'])->whereHas('posts', function($q) use($id) {
	   // Query the name field in status table
			   $q->where('post_idpost', '=', $id); // '=' is optional
		})->get();
	   $post = UserHasPost::where('post_idpost',$id)->first();
	   $commentsData = [];
	   $replies = [];
	   foreach ($comments as $key) {
		   $user = User::find($key->user_iduser);
		   $name = $user->name;
		   $replies = $this->replies($key->idcomentarios, $id);
		   $photo = (PessoaFisica::where('user_iduser','=',$key->user_iduser)->with(['imagem'])->first())['imagem'];
		   // dd($photo->get());
		   $reply = 0;          
		   if(sizeof($replies) > 0){
			   $reply = 1;
		   }
			array_push($commentsData,[
				"name" => $name,
				"iduser" => $key->user_iduser,
				"photo_url" => $photo,
				"commentid" => $key->idcomentarios,
				"idpostuser" => $post->user_iduser,
				"comment" => $key->texto,
				"idimagem" => $key->imagens_idimagens,
				"imagem" => $key->imagem,
				"reply" => $reply,
				"reply_id" => $key->reply_id,
				"replies" => $replies,
				"date" => (new Carbon($key->updated_at))->format('d/m/Y')
			]);
	   }
	   // dd($commentsData);
	   $collection = collect($commentsData);
	   return $collection;
   }
    protected function replies($commentId,$id){
	   $comments = Comentarios::where('reply_id',$commentId)->with(['imagem'])->get();
	   $post = UserHasPost::where('post_idpost',$id)->first();
	   $replies = [];
	   foreach ($comments as $key) {
		   $user = User::find($key->user_iduser);
		   $name = $user->name;
		   $photo = (PessoaFisica::where('user_iduser','=',$key->user_iduser)->with(['imagem'])->first())['imagem'];
		   $r = $this->replies($key->idcomentarios, $id);        
		   $reply = 0;          
		   if(sizeof($r) > 0){
			   $reply = 1;
		   }
			array_push($replies,[
				"name" => $name,
				"iduser" => $key->user_iduser,
				"photo_url" => $photo,
				"idpostuser" => $post->user_iduser,
				"commentid" => $key->idcomentarios,
				"comment" => $key->texto,
				"reply_id" => $key->reply_id,
				"reply" => $reply,
				"idimagem" => $key->imagens_idimagens,
				"imagem" => $key->imagem,
				"date" => (new Carbon($key->updated_at))->format('d/m/Y')
			]);
			if (sizeof($r) > 0) {
				$replies = array_merge($replies, $r);
	 		}       
	    }
	    return $replies;
    }
    protected function oneComment($idcomentarios, $id){
       	$replies = [];
   		$key = Comentarios::where('idcomentarios',$idcomentarios)->with(['imagem'])->first();
   		$post = UserHasPost::where('post_idpost', $id)->first();
       	$user = User::find($key->user_iduser);
        $name = $user->name;
        $replies = $this->replies($key->idcomentarios,$id);
        $photo = (PessoaFisica::where('user_iduser','=',$key->user_iduser)->with(['imagem'])->first())['imagem'];
        $reply = 0;          
        if(sizeof($replies) > 0){
           	$reply = 1;
        }
        return [ "status" => "true","comment" => [
                "name" => $name,
				"iduser" => $key->user_iduser,
				"idpostuser" => $post->user_iduser,
                "photo_url" => $photo,
                "commentid" => $key->idcomentarios,
                "comment" => $key->texto,
                "idimagem" => $key->imagens_idimagens,
                "imagem" => $key->imagem,
                "reply" => $reply,
                "reply_id" => $key->reply_id,
                "replies" => $replies,
                "date" => (new Carbon($key->updated_at))->format('d/m/Y')
            ]];
    }
    public function getComentario($id,$idpost){
    	return $this->oneComment($id,$idpost);
    }
    public function deleteComentario($id){
    	$key = Comentarios::where('idcomentarios',$id)->first();
    	$k = $key->imagens_idimagens;
    	if ($key->reply_id != 0) {
    		Comentarios::where('reply_id', $id)->delete();
    		$key = Comentarios::where('idcomentarios', $id)->delete();
    	}else{
    		Comentarios::where('reply_id', $id)->delete();
    		PostHasComentarios::where('comentarios_idcomentarios',$id)->delete();
    		$key = Comentarios::where('idcomentarios',$id)->delete();
    	}
    	if ($k) {
    		$userIm= (new UserController)->deleteImagem($k);
    	}
    	return ['status'=> true];
    }
}
