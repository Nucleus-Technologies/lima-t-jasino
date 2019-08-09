<?php

namespace App\Models\Traits;

/**
 * Generates the slug during event creation
 */
trait Sluggable
{
    protected static function bootSluggable ()
    {
        static::creating(function($outfit) {
            $outfit->slug = str_slug($outfit->name);
        });
    }
}
