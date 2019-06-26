<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    protected $table = 'cities';
    // Primary Key
    public $primaryKey = 'id';
   
    protected $fillable = [
        'name', 'state_id'
    ];
}
