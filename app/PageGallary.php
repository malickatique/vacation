<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageGallary extends Model
{
    //
    protected $table = 'pages_gallary';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'page_id', 'image'
    ];
}
