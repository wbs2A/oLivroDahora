<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'avaliacao';
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idavaliacao';
    public $timestamps = false;
    protected $fillable = ['quantidade', 'user_iduser'];

	public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_iduser');
    }
    public function posts()
    {
        return $this->belongsToMany(\App\Model\Post::class, 'post_has_avaliacao', 'avaliacao_idavaliacao','post_idpost');
    }
}
