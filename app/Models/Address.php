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
        'user', 'first_name', 'last_name', 'email', 'zone', 'country', 'phone1',
        'phone2', 'addressline1', 'addressline2', 'region', 'city', 'zip'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }
}
