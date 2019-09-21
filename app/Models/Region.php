<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Region extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label'
    ];

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }

    public function relaypoints()
    {
        return $this->hasMany('App\Models\RelayPoint');
    }
}
