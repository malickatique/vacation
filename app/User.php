<?php

namespace App;

use App\User;
use App\Message;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'user_type', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = true;
    
    public function owner()
    {
        return $this->hasOne('App\Owner');
        //return $this->hasOne('App\Owner');
    }
    public function billing()
    {
        return $this->hasOne('App\OwnerMetadata');
        //return $this->hasOne('App\Owner');
    }

    public function property(){
        return $this->hasOne('App\Property');
    }

    
    //Relationship between User and message
    public function messages()
    {
        return $this->hasMany(Message::class);    
    }
    

}
