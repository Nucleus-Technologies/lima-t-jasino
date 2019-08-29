<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminRequest;

class AdminLoginController extends Controller
{
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(AdminRequest $request)
    {
        // Attempt to log the user in
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            // If successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($credentials);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
