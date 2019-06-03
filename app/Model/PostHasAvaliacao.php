<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostHasAvaliacao extends Model
{
    protected $table = 'post_has_avaliacao';
	public $incrementing = false;
	public $timestamps = false;
	protected $fillable = ['post_idpost', 'avaliacao_idavaliacao','iduser'];

	public function avaliacao()
	{
		return $this->belongsTo(\App\Model\Avaliacao::class, 'avaliacao_idavaliacao');
	}

	public function post()
	{
		return $this->belongsTo(\App\Model\Post::class, 'post_idpost');
	}
}
