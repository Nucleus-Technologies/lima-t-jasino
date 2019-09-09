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
        'user', 'outfit', 'quantity', 'source'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }

    public function outfits()
    {
        return $this->hasMany('App\Models\Outfit', 'id');
    }
}
