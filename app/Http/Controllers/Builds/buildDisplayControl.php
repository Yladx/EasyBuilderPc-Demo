<?php

namespace App\Http\Controllers\Builds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Build;
use App\Http\Controllers\Builds\View\fetchBuild;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class buildDisplayControl extends Controller
{
    public function DisplayBuild($tag = null) {
        $displaybuilds = app(fetchBuild::class)->loadbuild($tag);
        return view('user.viewpcbuild', compact('displaybuilds'));
    }

    public function getbuildinfo($id) {
        // Fetch the build data with related parts
        $buildinfo = Build::with([
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

        // Check if the user has already rated the build
        $userHasRated = false;
        $userRating = null;

        if (Auth::check()) {
            $rating = $buildinfo->ratings()->where('user_id', Auth::id())->first();
            if ($rating) {
                $userHasRated = true;
                $userRating = $rating->rating;
            }
        }

        // Calculate the average rating
        $averageRating = $buildinfo->ratings()->avg('rating');


        // Return the modal content with the build details and rating information
        return view('user.build-components.buildinfo', compact('buildinfo', 'averageRating', 'userHasRated', 'userRating'));
    }
}
