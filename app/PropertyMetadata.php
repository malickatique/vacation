<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyMetadata extends Model
{
    //
    protected $table = 'property_metadata';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'property_id', 'type', 'status', 'location','bedrooms','bathrooms','floors','garages','area','size'
    ];

    public function property(){
        return $this->belongsTo('App\Property');
    }

        
}
