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
    protected $fillable = ['texto', 'user_iduser', 'reply_id','imagens_idimagens'];
    protected $casts = [
        'updated_at'  => 'date:d-m-y H:00',
    ];
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_iduser');
    }
    public function posts()
    {
        return $this->belongsToMany(\App\Model\Post::class, 'post_has_comentarios', 'comentarios_idcomentarios','post_idpost');
    }
   //  public function replies()
   // {
   //     return $this->hasMany(Comentarios::class,'idcomentarios','reply_id');
   // }
   public function imagem()
    {
        return $this->hasOne(\App\Model\Imagens::class, 'idimagens','imagens_idimagens' );
    }
}
