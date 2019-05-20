<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Imagens extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'imagens';
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idimagens';

    public function posts()
    {
        return $this->belongsToMany(\App\Model\Post::class, 'post_has_imagens', 'imagens_idimagens','post_idpost');
    }
}
