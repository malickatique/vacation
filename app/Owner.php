<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{   
    //
    protected $table = 'user_metadata';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;


    protected $fillable = ['user_id', 'name', 'surname', 'city', 'state', 'zip', 'address', 'number', 'driving_license'];

    public function user()
    {
        //return $this->belongsTo('App\User','foreign_key','user_id')->withDefault();
        return $this->belongsTo('App\User');
    }
}