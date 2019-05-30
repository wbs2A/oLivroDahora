<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $fillable = [
        'user_id', 'friend_id'
    ];

    public function users(){
        return $this->belongsToMany(User::class,'user_friends','friend_id','user_id');
    }
}
