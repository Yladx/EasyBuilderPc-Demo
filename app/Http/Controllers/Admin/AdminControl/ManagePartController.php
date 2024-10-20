<?php
namespace App\Http\Controllers\Admin\AdminControl;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Build;
use Illuminate\Http\Request; // Missing import for Request
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ManagePartController extends AdminController
{

// Fetch all CPUs
 public function getAllCpus()
 {
     return DB::table('cpus')->get(); // Fetch all CPUs
 }

 // Fetch all GPUs
 public function getAllGpus()
 {
     return DB::table('gpus')->get(); // Fetch all GPUs
 }

 // Fetch all Motherboards
 public function getAllMotherboards()
 {
     return DB::table('motherboards')->get(); // Fetch all Motherboards
 }

 // Fetch all RAMs
 public function getAllRams()
 {
     return DB::table('rams')->get(); // Fetch all RAMs
 }


 // Fetch all Storage devices
 public function getAllStorages()
 {
     return DB::table('storages')->get(); // Fetch all Storage devices
 }

 // Fetch all Power Supplies
 public function getAllPowerSupplies()
 {
     return DB::table('power_supplies')->get(); // Fetch all Power Supplies
 }

 // Fetch all Cases
 public function getAllCases()
 {
     return DB::table('computer_cases')->get(); // Fetch all Cases
 }

 public function getComponentData(Request $request)
{
    $componentType = $request->get('componentType');

    // List of allowed components and corresponding table names
    $allowedComponents = [
        'cpus' => 'cpus',
        'gpus' => 'gpus',
        'motherboards' => 'motherboards',
        'rams' => 'rams',
        'storages' => 'storages',
        'power_supplies' => 'power_supplies',
        'cases' => 'computer_cases',
    ];

    if (array_key_exists($componentType, $allowedComponents)) {
        // Fetch the data and columns for the selected component
        $data = DB::table($allowedComponents[$componentType])->get();
        $columns = Schema::getColumnListing($allowedComponents[$componentType]); // Get column names

        return response()->json([
            'success' => true,
            'columns' => $columns,
            'data' => $data,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Invalid component type'
        ]);
    }
}
}
