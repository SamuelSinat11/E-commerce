<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash; // Import Hash facade
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\Admin;

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
        return view('admin.index');
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
                ->with('success', 'Login Successful');
        } else {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Invalid Credentials');
        }
    }

    /**
     * Handle admin logout.
     */
    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()
            ->route('admin.login')
            ->with('success', 'Logout Successful');
    }

    /**
     * Show the forget password form.
     */
    public function AdminForgetPassword()
    {
        return view('admin.forget_password');
    }

    /**
     * Handle forget password submission.
     */
    public function AdminPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin_data = Admin::where('email', $request->email)->first();

        if (!$admin_data) {
            return redirect()
                ->back()
                ->with('error', 'Email Not Found');
        }

        $token = hash('sha256', time());
        $admin_data->token = $token;
        $admin_data->update();

        $reset_link = url('admin/reset-password/' . $token . '/' . $request->email);
        $subject = "Reset Password";
        $message = "Please click on the link below to reset your password:<br>";
        $message .= "<a href='" . $reset_link . "'>Click Here</a>";

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()
            ->back()
            ->with('success', 'Reset Password Link Sent to Your Email');
    }

    /**
     * Show the reset password form.
     */
    public function AdminResetPassword($token, $email)
    {
        $admin_data = Admin::where('email', $email)
            ->where('token', $token)
            ->first();

        if (!$admin_data) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Invalid Token or Email');
        }

        return view('admin.reset_password', compact('token', 'email'));
    }

    /**
     * Handle reset password submission.
     */
    public function AdminResetPasswordSubmit(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        $admin_data = Admin::where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$admin_data) {
            return redirect()
                ->route('admin.login')
                ->with('error', 'Invalid Token or Email');
        }

        $admin_data->password = Hash::make($request->password);
        $admin_data->token = "";
        $admin_data->update();

        return redirect()
            ->route('admin.login')
            ->with('success', 'Password Reset Successfully');
    }

    /**
     * Show the admin profile page.
     */
    public function AdminProfile()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }

    /**
     * Update admin profile data.
     */
    public function AdminProfileStore(Request $request)
    {
        $id = Auth::guard('admin')->id();
        $data = Admin::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                $this->deleteOldImage($oldPhotoPath);
            }
        }

        $data->save();
        $notification = [
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    /**
     * Delete old profile image from storage.
     */
    private function deleteOldImage(string $oldPhotoPath): void
    {
        $fullPath = public_path('upload/admin_images/' . $oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    /**
     * Show the change password page.
     */
    public function AdminChangePassword()
    {
        $id = Auth::guard('admin')->id();
        $profileData = Admin::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }


    public function AdminPasswordUpdate(Request $request) { 
        $admin = Auth::guard('admin') -> user(); 
        $request -> validate([ 
            'old_password' => 'required', 
            'new_password' => 'required|confirmed'
        ]);

        if (Hash ::check($request -> old_password, $admin->password)) { 
            $notification = array ( 
                'message' => 'Old Password Does not Match! ', 
                'alert-type' => 'error'
            ); 

            return back() -> with ($notification); 
        }

        // Update the new Password 
        Admin::whereId($admin->id) -> update([
            'password' => Hash::make($request->new_password)
        ]); 

            $notification = array( 
                'message' => 'Password Change Successfully', 
                'alert-type' => 'success'
            ); 
            return back() -> with ($notification); 
    }
}
