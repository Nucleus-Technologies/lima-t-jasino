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
        'user_id', 'outfit_id', 'quantity', 'source'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function session()
    {
        return $this->belongsTo('App\Models\Session', 'user_id');
    }

    public function outfit()
    {
        return $this->belongsTo('App\Models\Outfit');
    }

    public function getTotalPriceAttribute()
    {
        return $this->outfit->price * $this->quantity;
    }
}
