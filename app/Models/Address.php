<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'zone', 'country', 'phone1',
        'phone2', 'addressline1', 'addressline2', 'region_id', 'city_id', 'zip', 'current'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
