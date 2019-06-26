<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table = 'properties';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'template_id', 'name', 'description','availability_from','availability_to','per_night_rent','address','thumbnail','status'
         
    ]; 

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function metadata(){
        return $this->hasOne('App\PropertyMetadata');
    }

    public function features(){
        return $this->hasMany('App\PropertyFeature', 'property_id', 'id');
    }

    public function occasions(){
        return $this->hasMany('App\PropertyOccasion', 'property_id', 'id');
    }

    public function gallary(){
        return $this->hasMany('App\PropertyGallary', 'property_id', 'id');
    }

   
    
}
