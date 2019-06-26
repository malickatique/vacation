<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionFeature extends Model
{
    //
    protected $table = 'subscription_feature';
    // Primary Key
    public $primaryKey = 'id';
   
    protected $fillable = [
        'feature_name'
    ];

    

    public function subscription(){
        return $this->belongsTo('App/Subscription');
    }

}
