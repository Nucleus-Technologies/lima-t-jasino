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
        'name', 'slug', 'price', 'category', 'type', 'availibility',
        'context', 'description', 'specification', 'images'
    ];

    public function type()
    {
        return $this->hasOne('App\Models\Type', 'type');
    }

    public function outfitphotos() {
        return $this->hasMany('App\Models\OutfitPhoto', 'outfit');
    }

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'outfit');
    }
}
