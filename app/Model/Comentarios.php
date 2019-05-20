<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
   	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comentarios';
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idcomentarios';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_iduser');
    }
    public function posts()
    {
        return $this->belongsToMany(\App\Model\Post::class, 'post_has_comentarios', 'comentarios_idcomentarios','post_idpost');
    }
}
