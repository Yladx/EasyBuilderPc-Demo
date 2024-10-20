<?php

namespace App\Http\Controllers\Builds\View;

use App\Http\Controllers\Builds\buildDisplayControl;
use Illuminate\Http\Request;
use App\Models\Build; // Ensure to import the Build model
use Illuminate\Support\Facades\DB;

class fetchBuild extends buildDisplayControl
{
    public function loadbuild($tag) {
        // Base query with left join to fetch builds and average rating from the rate table
        $query = Build::leftJoin('rate', 'builds.id', '=', 'rate.build_id')
        ->select(
            'builds.id',
            'builds.user_id',
            'builds.tag',
            'builds.build_name',
            'builds.build_note',
            DB::raw('AVG(rate.rating) as average_rating')
        )
        ->where('builds.published', true) // Ensure only published builds are fetched
        ->groupBy('builds.id', 'builds.user_id', 'builds.tag', 'builds.build_name', 'builds.build_note');

if ($tag == '') {
// Return all published builds
return $query->get();
} else if ($tag == 'recommended') {
// Return published builds where user_id is null (recommended builds)
return $query->whereNull('builds.user_id')->get();
} else {
// Handle multiple tags separated by commas
$tags = explode(',', $tag); // Split the tag string by comma
return $query->where(function($q) use ($tags) {
  foreach ($tags as $t) {
      $q->orWhereRaw('FIND_IN_SET(?, builds.tag)', [trim($t)]);
  }
})->get();


        }

    }




}


