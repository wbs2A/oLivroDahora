<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostHasComentarios extends Model
{
    protected $table = 'post_has_comentarios';
	public $incrementing = false;
	public $timestamps = false;
	protected $fillable = ['post_idpost', 'comentarios_idcomentarios','comentarios_user_iduser'];
	public function comentario()
	{
		return $this->belongsTo(\App\Model\Comentario::class, 'comentarios_idcomentarios');
	}

	public function post()
	{
		return $this->belongsTo(\App\Model\Post::class, 'post_idpost');
	}
}
