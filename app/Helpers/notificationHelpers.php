<?php
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\AppointmentMessage;

if (!function_exists('number_notif_unread')) {
    function number_notif_unread($user, $type) {
        return Notification::where('type', $type)
            ->where('to', $user)
            ->where('read', 0)
            ->get()
            ->count();
    }
}

if (!function_exists('format_about')) {
    function format_about($about) {
        $expressions = [
            'appointment' => 'New appointment.',
            'appointment_message' => 'New appointment message.'
        ];

        return $expressions[$about];
    }
}

if (!function_exists('format_sender')) {
    function format_sender($type, $about, $item) {
        $element = $full_name = NULL;

        switch ($type) {
            case 'user':
                return 'From ours tailors.';
                break;

            default:
                if ($about == 'appointment') {
                    $element = Appointment::where('id', $item)->first();
                    $full_name = User::where('id', $element->user)->first()->full_name;
                }
                elseif ($about == 'appointment_message') {
                    $element = AppointmentMessage::where('id', $item)->first();
                    $full_name = User::where('id', $element->from)->first()->full_name;
                }

                return 'From ' .$full_name. '.';
                break;
        }
    }
}

if (!function_exists('format_created_at')) {
    function format_created_at($created_at) {
        $now = Carbon::now();

        $diff_minutes = $now->diffInMinutes($created_at);
        $diff_hours = $now->diffInHours($created_at);
        $diff_days = $now->diffInDays($created_at);

        if ($diff_minutes == 0) return 'Just now';
        else {
            if ($diff_minutes <= 59) return $diff_minutes . ' minutes ago';
            else {
                if ($diff_minutes == 60) return '1 hour ago';
                else {
                    if ($diff_hours <= 23) return $diff_hours . ' hours ago';
                    else {
                        if ($diff_hours == 24) return '1 day ago';
                        else {
                            if ($diff_days <= 31) return $diff_days . ' days ago';
                            else format_date($created_at) . ' at ' . format_time($created_at);
                        }
                    }
                }
            }
        }
    }
}

if (!function_exists('format_item')) {
    function format_item($about, $item) {
        switch ($about) {
            case 'appointment':
                $appointment = Appointment::where('id', $item)->first();

                return 'On the ' .format_date($appointment->takes_place_the)
                    . ' from ' .format_time($appointment->starts_at). ' to ' .format_time($appointment->ends_at);
                break;

            case 'appointment_message':
                $message = AppointmentMessage::where('id', $item)->first();
                return back_to_line(format_message($message->answered_message, 120));
                break;

            default:
                return 'Missing column data!';
                break;
        }
    }
}
