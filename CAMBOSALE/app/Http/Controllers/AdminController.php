<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function AdminLogin()
    {
        return view('admin.login');
    }

    /**
     * Show the admin dashboard.
     */
    public function AdminDashboard()
    {
        return view('admin.admin_dashboard');
    }

    /**
     * Handle admin login submission.
     */
    public function AdminLoginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Login Successfully');
        } else {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Invalid Credentials');
        }
    }

    public function AdminLogout() { 
        Auth::guard('admin') -> logout(); 
        return redirect() 
            -> route ('admin.login')
            -> with ('success', 'Logout Success'); 
    }
}
