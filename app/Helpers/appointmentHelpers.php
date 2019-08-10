<?php
use App\Models\Appointment;

if (!function_exists('totalBy')) {
    function totalByDone($done) {
        return Appointment::where('done', $done)->count();
    }
}
