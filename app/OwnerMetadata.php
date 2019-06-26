<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerMetadata extends Model
{
    //
    protected $table = 'user_billing_info';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'card_number', 'exp_month', 'exp_year','sec_code'
    ];

    public function user()
    {
        //return $this->belongsTo('App\User','foreign_key','user_id')->withDefault();
        return $this->belongsTo('App\User');
    }
}
