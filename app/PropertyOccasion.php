<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyOccasion extends Model
{
    //
    protected $table = 'property_occasion';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'property_id', 'occasion_name', 'availability_from', 'availability_to', 'per_night_rent'
    ];

    public function propertyoccasion(){
        return $this->belongsTo('App/Property');
    }
}
