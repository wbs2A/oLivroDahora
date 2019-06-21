<?php

namespace App;

use App\Model\Friend;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'telefone', 'tipo', 'password'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friendsOfMine(){
        return $this->belongsToMany('\App\Model\Friend', 'friends', 'user_id', 'friend_id');
    }


    public function friendsOf(){
        return $this->belongsToMany('\App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends(){
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');// $this->friendsOfMine();//->merge($this->friendsOf());
    }
    public function avaliacoes()
    {
        return $this->hasMany(\App\Model\Avaliacao::class, 'user_iduser');
    }
    public function posts()
    {
        return $this->belongsToMany(\App\Model\Post::class, 'user_has_post', 'user_iduser','post_idpost');
    }
    public function pessoaFisica()
    {
        return $this->hasOne(\App\Model\PessoaFisica::class, 'user_iduser');
    }
    public function compras(){
        return $this->belongsToMany(\App\Model\Compra::class, 'user_has_compra', 'compra_idcompra', 'user_iduser');
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); // my notification
    }

    public function produto(){
        return $this->belongsToMany(\App\Model\Livro::class,'user_has_livro', 'livro_idlivro', 'user_iduser');
    }
}
