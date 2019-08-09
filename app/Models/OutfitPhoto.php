<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutfitPhoto extends Model
{
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'outfit', 'filename'
    ];

    public function outfit()
    {
        return $this->belongsTo('App\Models\Outfit');
    }
}
