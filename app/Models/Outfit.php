<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Sluggable;
use App\Models\Traits\SlugRoutable;

class Outfit extends Model
{
    use Notifiable, Sluggable, SlugRoutable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'price', 'category', 'type_id', 'availibility',
        'context', 'description', 'specification', 'images'
    ];

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    public function outfitphotos() {
        return $this->hasMany('App\Models\OutfitPhoto');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function orderlines()
    {
        return $this->hasMany('App\Models\OrderLine');
    }
}
