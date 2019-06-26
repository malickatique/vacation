<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    // 
    protected $table = 'property_features';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'property_id', 'feature_id'
        
    ];

    public function property(){
        return $this->belongsTo('App\Property');
    }

    public function feature(){
        return $this->belongsTo('App\Feature');
    }
    

}
