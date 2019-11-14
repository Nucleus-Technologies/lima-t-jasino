<?php
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\AppointmentMessage;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

if (!function_exists('number_notif_unread')) {
    function number_notif_unread($type) {
        return Auth::user()->notifications()
            ->where('type', $type)
            ->where('read', 0)
            ->get()
            ->count();
    }
}

if (!function_exists('format_about')) {
    function format_about($about) {
        $expressions = [
            'appointment' => 'New appointment.',
            'appointment_message' => 'New appointment message.',
            'order_payment' => 'New Order Payment.'
        ];

        return $expressions[$about];
    }
}

if (!function_exists('format_sender')) {
    function format_sender($type, $about, $item) {
        $element = $full_name = NULL;

        switch ($type) {
            case 'user':
                return 'From our managers.';
                break;

            default:
                if ($about == 'appointment') {
                    $element = Appointment::find($item);
                    $full_name = $element->user->full_name;
                }
                elseif ($about == 'appointment_message') {
                    $element = AppointmentMessage::find($item);
                    $full_name = $element->appointment->user->full_name;
                }
                elseif ($about == 'order_payment') {
                    $element = Order::find($item);
                    $full_name = $element->user->full_name;
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
                if ($diff_minutes == 60 || $diff_hours == 1) return '1 hour ago';
                else {
                    if ($diff_hours <= 23) return $diff_hours . ' hours ago';
                    else {
                        if ($diff_hours == 24 || $diff_days == 1) return '1 day ago';
                        else {
                            if ($diff_days <= 31) return $diff_days . ' days ago';
                            else return format_date($created_at) . ' at ' . format_time($created_at);
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
                $appointment = Appointment::find($item);

                return 'On the ' .format_date($appointment->takes_place_the)
                    . ' from ' .format_time($appointment->starts_at). ' to ' .format_time($appointment->ends_at);
                break;

            case 'appointment_message':
                $message = AppointmentMessage::find($item);
                return back_to_line(format_message($message->answered_message, 120));
                break;

            case 'order_payment':
                $order = Order::find($item);
                return 'Passed on the ' . format_date($order->created_at);
                break;

            default:
                return 'Missing column data!';
                break;
        }
    }
}
