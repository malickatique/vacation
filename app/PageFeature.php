<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageFeature extends Model
{
    //
    //
    protected $table = 'pages_feature';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'page_id', 'feature', 'status'
    ];
}
