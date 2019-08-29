<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cart extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'outfit', 'quantity'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }

    public function outfit()
    {
        return $this->hasMany('App\Models\Outfit', 'outfit');
    }
}
