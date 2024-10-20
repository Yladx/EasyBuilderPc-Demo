<?php

namespace App\Http\Controllers\Admin\AdminControl;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Build;
use Illuminate\Http\Request; // Missing import for Request
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class BuildController extends AdminController
{

    public function getRecommendedBuild()
    {
        return Build::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase'])
        ->withAvg('ratings', 'rating') // Calculate average rating
        ->whereNull('user_id') // Admin builds
        ->get();
    }

    public function getUserBuild()
    {
        return Build::with(['cpu', 'gpu', 'motherboard', 'ram', 'storage', 'powerSupply', 'pcCase', 'user'])
        ->withAvg('ratings', 'rating') // Calculate average rating
        ->whereNotNull('user_id') // User builds
        ->get();
    }



    // Count builds
    public function countBuilds(): \Illuminate\Support\Collection
    {
        return DB::table('builds')
            ->selectRaw("'Total User Builds' AS row_name, COUNT(*) AS total_count")
            ->whereNotNull('user_id')
            ->unionAll(
                DB::table('builds')
                    ->selectRaw("'Total Admin Builds' AS row_name, COUNT(*) AS total_count")
                    ->whereNull('user_id')
            )
            ->unionAll(
                DB::table('builds')
                    ->selectRaw("'Total Builds' AS row_name, COUNT(*) AS total_count")
            )
            ->get();
    }

    // Fetch total build counts and return as JSON
    public function fetchBuildCount(): JsonResponse
    {
        $buildCounts = $this->countBuilds();
        return response()->json($buildCounts);
    }

    // Delete a build
    public function destroy($id)
    {
        $build = Build::find($id);

        if (!$build) {
            return response()->json(['error' => 'Build not found'], 404);
        }

        $build->delete();

        return response()->json(['success' => 'Build deleted successfully'], 200);
    }






















    // Show create build form
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'build_name' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'motherboard_id' => 'required|exists:motherboards,id',
            'cpu_id' => 'required|exists:cpus,id',
            'ram_id' => 'required|exists:rams,id',
            'gpu_id' => 'required|exists:gpus,id',
            'storage_id' => 'required|exists:storages,id',
            'power_supply_id' => 'required|exists:power_supplies,id',
            'case_id' => 'required|exists:computer_cases,id',
            'accessories' => 'nullable|string',

        ]);

        // Store the data in the builds table
        $build = new Build();
        $build->build_name = $request->build_name;
        $build->tag = $request->tag;
        $build->motherboard_id = $request->motherboard_id;
        $build->cpu_id = $request->cpu_id;
        $build->ram_id = $request->ram_id;
        $build->gpu_id = $request->gpu_id;
        $build->storage_id = $request->storage_id;
        $build->power_supply_id = $request->power_supply_id;
        $build->case_id = $request->case_id;
        $build->accessories = $request->accessories;

        $build->save(); // Save the build data to the database

        // Redirect or return a response
        return redirect()->back()->with('success', 'Build created successfully!');
    }
}
