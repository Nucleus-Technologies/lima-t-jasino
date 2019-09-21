<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ref', 'user_id', 'address_id', 'relaypoint_id', 'current'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function relaypoint()
    {
        return $this->belongsTo('App\Models\RelayPoint');
    }

    public function orderlines()
    {
        return $this->hasMany('App\Models\OrderLine');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }
}
