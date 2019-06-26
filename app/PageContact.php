<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageContact extends Model
{
    //
    protected $table = 'pages_contact';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'page_id', 'address', 'email', 'contact', 'map'
    ];

}
