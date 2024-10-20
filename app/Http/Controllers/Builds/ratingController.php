<?php
namespace App\Http\Controllers\Builds;

use Illuminate\Http\Request;
use App\Models\Rate; // Ensure you import the Rate model
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ratingController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'rating' => 'required|integer|between:1,5', // Ensure rating is between 1 and 5
            'build_id' => 'required|exists:builds,id' // Ensure build_id is valid
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create a new rating
        Rate::updateOrCreate(
            [
                'build_id' => $request->input('build_id'),
                'user_id' => $user->id,
            ],
            [
                'rating' => $request->input('rating'),
                'rated_at' => now(),
            ]
        );

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for rating this build!');
    }
}
