<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\AppointmentMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppointmentFormRequest;
use App\Http\Requests\AppointmentMessageRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointment for users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_u()
    {
        $appointments = Appointment::where('user', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        return view('customer.appointment.index', compact('appointments'));
    }

    /**
     * Display a listing of the appointment for admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_a()
    {
        $appointments_done = Appointment::where('done', 1)
            ->orderBy('user')->orderBy('created_at', 'desc')->get();
        $appointments_not_done = Appointment::where('done', 0)
            ->orderBy('user')->orderBy('created_at', 'desc')->get();

        return view('admin.appointment.index', compact('appointments_done', 'appointments_not_done'));
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.appointment.create');
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  \App\Http\Requests\AppointmentFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentFormRequest $request)
    {
        $appointment = Appointment::create([
            'user' => Auth::user()->id,
            'location' => $request->location,
            'takes_place_the' => $request->takes_place_the,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'specified_message' => nl2br($request->specified_message),
            'done' => 0
        ]);

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($appointment) {
            $response = ['msg' => 'Your appointment has been successfully booked!', 'status' => true];
        }

        return response()->json($response);
    }

    /**
     * Display the specified appointment.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        $messages = AppointmentMessage::where('appointment', $appointment->id)->get();

        if (isset(Auth::user()->username)) {
            return view('admin.appointment.show', compact('appointment', 'messages'));
        }

        return view('customer.appointment.show', compact('appointment', 'messages'));
    }

    /**
     * Show the form for editing the specified appointment.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified appointment in storage.
     *
     * @param  \App\Http\Requests\AppointmentFormRequest $request
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified appointment from storage.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    /**
     * Reply to the specified appointment.
     *
     * @param  AppointmentMessageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function reply(AppointmentMessageRequest $request)
    {
        $appointment = Appointment::findOrFail(decrypt_id($request->appointment));

        $appointment_message = AppointmentMessage::create([
            'origin' => (Auth::user()->username) ? 'admin' : 'user',
            'from' => Auth::user()->id,
            'to' => $appointment->user,
            'appointment' => $appointment->id,
            'answered_message' => nl2br($request->answered_message)
        ]);

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($appointment_message) {
            $response = ['msg' => 'Your reply has been successfully sent!', 'status' => true];
        }

        return response()->json($response);
    }

    /**
     * Mark a specified appointment as done.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function done(Appointment $appointment)
    {
        $check_done = $appointment->update(['done' => 1]);

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($check_done) {
            $response = ['msg' => 'This appointment has been successfully marked as done!', 'status' => true];
        }

        return response()->json($response);
    }
}
