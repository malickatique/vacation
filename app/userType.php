<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userType extends Model
{
    protected $fillable = [
        'user_type', 'description'
    ];
}
