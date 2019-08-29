<?php
use App\Models\Appointment;

if (!function_exists('total_by_done')) {
    function total_by_done($done) {
        return Appointment::where('done', $done)->count();
    }
}
