<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RelayPoint extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id', 'city_id', 'label', 'near', 'address', 'contact', 'opening_hours', 'shipping_cost'
    ];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
