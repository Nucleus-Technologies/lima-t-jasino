<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class City extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region_id', 'label'
    ];

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function address()
    {
        return $this->belongsTo('App\Models\Address');
    }

    public function relaypoint()
    {
        return $this->hasOneThrough('App\Models\RelayPoint', 'App\Models\Region');
    }
}
