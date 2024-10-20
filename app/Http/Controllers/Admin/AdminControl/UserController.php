<?php

namespace App\Http\Controllers\Admin\AdminControl;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends AdminController
{
    // Fetch all users
    public function fetchUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    // New method to match your JavaScript call


    // Private method to fetch users from the database
    public function getUsers(): \Illuminate\Support\Collection
    {
        return DB::table('users')
            ->select('id', 'name', 'lname', 'fname', 'email', 'email_verified_at', 'created_at', 'updated_at')
            ->get();
    }


    // Private method to fetch users from the database
    public function showUserInfo($id)
    {
        // Fetch the user with the given ID and load their activity logs
        $user = User::with('activityLogs')->find($id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404); // Return a JSON response for a non-existing user
        }

        // Return the view with user information and activity logs
        return view('admin.data.ActivityLog.UserInfo', compact('user'));
    }


}

