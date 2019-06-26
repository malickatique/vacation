<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageBox extends Model
{
    //
    protected $table = 'grid_boxes';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'page_id', 'section_heading', 'section_heading_paragraph'
    ];
}
