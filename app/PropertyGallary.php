<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyGallary extends Model
{
    //
    protected $table = 'property_gallary';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'property_id', 'media', 'type'
    ];

    public function propertygallary(){
        return $this->belongsTo('App/Property');
    }

   


}
