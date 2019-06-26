<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageBoxMetadata extends Model
{
    //
    protected $table = 'grid_boxes_metadata';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'grid_box_id', 'box_heading', 'box_paragraph'
    ];
    
}
