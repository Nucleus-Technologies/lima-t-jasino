<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\AppointmentMessage;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of customer and admin notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset(Auth::user()->username)) {
            $notifications = Auth::user()->notifications()
                ->where('type', 'admin')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.notification.index', compact('notifications'));
        } else {
            $notifications = Auth::user()->notifications()
                ->where('type', 'user')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('customer.notification.index', compact('notifications'));
        }
    }

    /**
     * Store a newly created notification in storage.
     *
     * @param  \App\Http\Requests\NotificationRequests  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request = [])
    {
        Notification::create([
            'type' => $request['type'],
            'about' => $request['about'],
            'to' => $request['to'],
            'item' => $request['item'],
            'read' => 0
        ]);
    }

    /**
     * Mark the specified notification as read.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function read(Notification $notification)
    {
        $check_read = $notification->update(['read' => 1]);

        switch ($notification->about) {
            case 'appointment':
                if ($notification->type == 'user') return route('appointment.show', $notification->item);
                else return redirect(route('admin.appointment.show', $notification->item));
                break;

            case 'appointment_message':
                $message = AppointmentMessage::find($notification->item);
                if ($notification->type == 'user') return redirect(route('appointment.show', $message->appointment . '#msg' .$notification->item));
                else return redirect(route('admin.appointment.show', $message->appointment . '#msg' .$notification->item));
                break;

            default:
                return 'Missing column data!';
                break;
        }
    }

    /**
     * Display the user notifications icon.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        if(isset(Auth::user()->username)) {
            return view('admin.layouts.partials._notification');
        } else {
            return view('customer.layouts.partials._notification');
        }
    }
}
