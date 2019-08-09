<?php

namespace App\Models\Traits;

/**
 * Returns the slug of an event
 */
trait SlugRoutable
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
