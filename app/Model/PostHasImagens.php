<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostHasImagens extends Model
{
    protected $table = 'post_has_imagens';
	public $incrementing = false;


	public function imagem()
	{
		return $this->belongsTo(\App\Model\Imagens::class, 'imagens_idimagens');
	}

	public function post()
	{
		return $this->belongsTo(\App\Model\Post::class, 'post_idpost');
	}
}
