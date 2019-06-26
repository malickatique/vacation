<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    //

    //
    protected $table = 'features';
    // Primary Key
    public $primaryKey = 'id';
   
    protected $fillable = [
        'name'
    ];

    public function property_feature(){
        return $this->hasOne('App\PropertyFeature' ,'feature_id', 'id');
    }

   
}
