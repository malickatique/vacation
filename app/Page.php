<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;


    protected $fillable = ['name', 'title', 'slug', 'content', 'short_description', 'keywords'];

    public function features(){
        return $this->hasMany('App\PageFeature', 'page_id', 'id');
    }


}



