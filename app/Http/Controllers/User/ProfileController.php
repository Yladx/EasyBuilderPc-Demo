<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // Method to return the user profile view with activity logs
    public function userprofile_view()
    {
        // Get the logged-in user's ID
        $userId = Auth::id();

        // Fetch the user's activity logs ordered by activity_timestamp
        $activities = DB::table('activity_logs')
                        ->where('user_id', $userId)
                        ->orderBy('activity_timestamp', 'desc')
                        ->get();

        // Pass the activity logs to the view
        return view('user.userprofile', compact('activities'));
    }


    public function update_user_profile(Request $request)
    {
        // Get the logged-in user's instance
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }

        // Validate the incoming request data
        $request->validate([
            'username' => 'required|string|max:255',
            'fname'    => 'required|string|max:255',
            'lname'    => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update user information
        $user->name = $request->input('username');
        $user->fname = $request->input('fname'); // Ensure these fields exist in the users table
        $user->lname = $request->input('lname'); // Ensure these fields exist in the users table
        $user->email = $request->input('email');

        // Save the updated user info
        $user->save();

        // Log the login activity
        DB::table('activity_logs')->insert([
            'user_id' => $user->id,
            'activity' => 'Updated Profile Info',
            'activity_timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }



}

