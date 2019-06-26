<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';
    // Primary Key
    public $primaryKey = 'id';
   
    protected $fillable = [
        'sortname', 'name', 'phonecode'
    ];


}
