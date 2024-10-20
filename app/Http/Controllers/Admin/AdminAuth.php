<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuth extends Controller
{
    // Admin login function
    public function adminloginPost(Request $request)
    {
        $request->validate([
            'adminUsername' => 'required',
            'adminPassword' => 'required',
        ]);

        $credentials = $request->only('adminUsername', 'adminPassword');

        if (Auth::guard('admin')->attempt(['username' => $credentials['adminUsername'], 'password' => $credentials['adminPassword']], $request->remember)) {
            $adminId = Auth::guard('admin')->id();

            // Log the login activity
            DB::table('admin_activity_logs')->insert([
                'admin_id' => $adminId,
                'activity' => 'Login',
                'activity_timestamp' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->intended(route('admindashboard'))->with('success', 'You have successfully logged in!');
        }

        return back()->withErrors(['loginError' => 'Invalid credentials provided. Please try again.'])->withInput();
    }

    // Admin logout function
    public function adminLogout()
    {
        $adminId = Auth::guard('admin')->id();
        DB::table('admin_activity_logs')->insert([
            'admin_id' => $adminId,
            'activity' => 'Logout',
            'activity_timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::guard('admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have successfully logged out.');
    }

    // Admin registration function
    public function createAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:admins,username',
            'password' => 'required|min:5',
        ]);

        $admin = new Admin();
        $admin->username = $request->username;
        $admin->password = Hash::make($request->password);
        $admin->remember_token = $request->remember;

        $admin->save();

        return redirect()->back()->with('success', 'Admin registered successfully.');
    }

    // Fetch activity logs

}
