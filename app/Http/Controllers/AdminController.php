<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;
use App\Models\OrderLine;
use App\Models\Outfit;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lines = OrderLine::select(DB::raw('outfit_id, count(outfit_id) as number_sales'))
            ->groupBy('outfit_id')
            ->orderBy('number_sales', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('lines'));
    }

    /**
     * Show the form for editing the admin credential data.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('admin.profile');
    }

    /**
     * Update the admin creadential data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        $check = $admin->where('id', Auth::user()->id)->update([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        $response = ['msg' => 'Something goes to wrong. Please try again again or later!', 'status' => false];

        if ($check) {
            $response = ['msg' => 'Credential data successfully updated!', 'status' => true];
        }

        return response()->json($response);
    }
}
