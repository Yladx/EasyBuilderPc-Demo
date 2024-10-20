<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Build;
use Illuminate\Http\Request;
class UserBuildController extends Controller
{
    // Method to display the logged-in user's build
    public function ShowUserBuild() {
        // Fetch all builds for the logged-in user
        $userbuilds = Build::with([
            'user',
            'cpu',
            'gpu',
            'motherboard',
            'ram',
            'storage',
            'powerSupply',
            'pcCase'
        ])->where('user_id', Auth::id())->get(); // Get all builds for the logged-in user


        return view('user.build-components.YourBuild', compact('userbuilds')); // Pass all builds to the view
    }

    public function getuserbuildsinfo($id) {
 // Fetch the build data with related parts
 $userbuildinfo = Build::with([
    'user',
    'cpu',
    'gpu',
    'motherboard',
    'ram',
    'storage',
    'powerSupply',
    'pcCase',
    'ratings'
])->findOrFail($id);


// Return the modal content with the build details and rating information
return view('user.build-components.BuildDetails', compact('userbuildinfo'));

    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'build_name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255',
            'build_note' => 'nullable|string|max:1000',
            'published' => 'boolean',
        ]);

        // Find the build by ID
        $userbuildinfo = Build::findOrFail($id);

        // Update the fields with new data
        $userbuildinfo->build_name = $request->input('build_name');
        $userbuildinfo->tag = $request->input('tag');
        $userbuildinfo->build_note = $request->input('build_note');
       // Set the is_published field based on the checkbox
    $userbuildinfo->published = $request->input('is_published') == '1'; // Cast to boolean

        // Save the updated build
        $userbuildinfo->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Build updated successfully!');
    }




     // Method to delete a specific build
     public function deleteBuild($id) {
        // Find the build that belongs to the logged-in user
        $build = Build::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        // If build not found or user does not own the build
        if (!$build) {
            return redirect()->back()->with('error', 'Build not found or unauthorized action.');
        }

        // Delete the build
        $build->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Build deleted successfully.');
    }




}
