<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AppointmentMessage extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'origin', 'from', 'to', 'appointment_id', 'answered_message'
    ];

    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment');
    }
}
