<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\Admin\AdminControl\ActivityLogController;
use App\Http\Controllers\Admin\AdminControl\UserController;
use App\Http\Controllers\Admin\AdminControl\BuildController;
use App\Http\Controllers\Admin\AdminControl\ManagePartController;

class AdminController extends Controller
{
    public function showDashboard()
    {
        // Fetch logs, users, and builds
        $logs = app(ActivityLogController::class)->fetchActivityLogs()->getData();
        $users = app(UserController::class)->getUsers();
        $builds = app(BuildController::class)->getRecommendedBuild();
        $userbuilds = app(BuildController::class)->getUserBuild();
        $buildCounts = app(BuildController::class)->countBuilds();

        // Fetch all parts
        $cpus = app(ManagePartController::class)->getAllCpus(); // Fetch all CPUs
        $gpus = app(ManagePartController::class)->getAllGpus(); // Fetch all GPUs
        $motherboards = app(ManagePartController::class)->getAllMotherboards(); // Fetch all Motherboards
        $rams = app(ManagePartController::class)->getAllRams(); // Fetch all RAMs
        $storages = app(ManagePartController::class)->getAllStorages(); // Fetch all Storage devices
        $powerSupplies = app(ManagePartController::class)->getAllPowerSupplies(); // Fetch all Power Supplies
        $cases = app(ManagePartController::class)->getAllCases(); // Fetch all Cases

        return view('admin.dashboard', compact(
            'logs',
            'users',
            'builds',
            'userbuilds',
            'buildCounts',
            'cpus',
            'gpus',
            'motherboards',
            'rams',
            'storages',
            'powerSupplies',
            'cases'
        ));
    }

    public function getComponentData(Request $request)
    {
        $componentType = $request->componentType;

        // Define a list of valid component tables
        $validTables = ['cpus', 'gpus', 'motherboards', 'rams', 'storages', 'power_supplies', 'cases'];

        // Check if the selected componentType is valid
        if (in_array($componentType, $validTables)) {
            // Get all column names of the selected table, except created_at and updated_at
            $columns = Schema::getColumnListing($componentType);
            $columns = array_diff($columns, ['created_at', 'updated_at']); // Exclude these columns

            // Fetch all data from the selected table
            $data = DB::table($componentType)->get();

            return response()->json([
                'columns' => $columns,
                'data' => $data
            ]);
        }

        // If the componentType is invalid, return an error response
        return response()->json(['error' => 'Invalid component type selected'], 400);
    }

    public function edit($type, $id)
    {
        $validTables = ['cpus', 'gpus', 'motherboards', 'rams', 'storages', 'power_supplies', 'cases'];

        if (in_array($type, $validTables)) {
            $item = DB::table($type)->find($id);
            // Return a view with the item data to edit
            return view('components.edit', compact('item', 'type'));
        }

        return redirect()->back()->withErrors(['error' => 'Invalid component type.']);
    }

    public function delete($type, $id)
    {
        $validTables = ['cpus', 'gpus', 'motherboards', 'rams', 'storages', 'power_supplies', 'cases'];

        if (in_array($type, $validTables)) {
            DB::table($type)->where('id', $id)->delete();
            return response()->json(['success' => 'Item deleted successfully']);
        }

        return response()->json(['error' => 'Invalid component type'], 400);
    }


}
