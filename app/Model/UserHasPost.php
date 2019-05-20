<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserHasPost extends Model
{
    protected $table = 'user_has_post';
	public $incrementing = false;


	public function user()
	{
		return $this->belongsTo(\App\User::class, 'user_iduser');
	}

	public function post()
	{
		return $this->belongsTo(\App\Model\Post::class, 'post_idpost');
	}
}
