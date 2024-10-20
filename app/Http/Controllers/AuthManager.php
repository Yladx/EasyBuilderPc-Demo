<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthManager extends Controller
{
    public function loginPost(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get credentials
        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Get the authenticated user's ID
            $userId = Auth::id(); // Retrieve the logged-in user's ID

            // Log the login activity
            DB::table('activity_logs')->insert([
                'user_id' => $userId,
                'activity' => 'Login',
                'activity_timestamp' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Set a session variable to indicate successful login
            session(['logged_in_user' => $userId]);

            // Redirect to the intended page with a success message
            return redirect()->intended(route('userhome'))->with('success', 'You have successfully logged in!');
        }

        // If login fails, return back with error and show login modal
        return back()->withErrors(['loginError' => 'Invalid credentials provided. Please try again.'])
                     ->withInput();
    }

    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'rpassword' => 'required|min:5',
        ]);

        $data = [
            'name' => $request->name,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->rpassword),
        ];

        $user = User::create($data);

        if (!$user) {
            // Return with error and keep registration modal open
            return back()->withErrors(['registerError' => 'Registration failed. Please try again.'])
                         ->withInput(); // Keep inputs for refresh
        }

        // Get the newly created user's ID
        $userId = $user->id;

        // Log the activity
        DB::table('activity_logs')->insert([
            'user_id' => $userId,
            'activity' => 'Account created',
            'activity_timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Set a session variable for the newly registered user
        session(['logged_in_user' => $userId]);

        // Redirect to the home route on successful registration
        return redirect()->route('login')->with('success', 'You have successfully registered!');
    }

    public function logout()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Log the logout activity
        DB::table('activity_logs')->insert([
            'user_id' => $userId,
            'activity' => 'Account logged out', // Update the activity message
            'activity_timestamp' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Clear the session and log the user out
        session()->flush(); // Clear all session data
        Auth::logout();

        // Redirect to the guest page
        return redirect('guest');
    }
}
