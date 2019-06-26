<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'receiver_id', 'conversation_id', 'send_at' ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
