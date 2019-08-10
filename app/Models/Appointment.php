<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'location', 'takes_place_the', 'starts_at', 'ends_at', 'specified_message', 'done'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }

    public function messages()
    {
        return $this->hasMany('App\AppointmentMessage');
    }
}
