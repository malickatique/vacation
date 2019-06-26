<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    //
    protected $table = 'subscription';
    // Primary Key
    public $primaryKey = 'id';
   
    protected $fillable = [
        'name', 'price', 'feature_id', 'status'
    ];

    

    public function option(){
        return $this->hasMany('App\SubscriptionFeature', 'subscription_id', 'id');
    }


}
