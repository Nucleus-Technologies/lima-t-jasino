<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Session extends Model
{
    use Notifiable;

    public function cart()
    {
        return $this->hasMany('App\Models\Cart', 'user_id');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Models\Wishlist', 'user_id');
    }
}
