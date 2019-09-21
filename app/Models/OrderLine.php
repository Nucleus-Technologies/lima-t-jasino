<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class OrderLine extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'outfit_id', 'quantity'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
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
