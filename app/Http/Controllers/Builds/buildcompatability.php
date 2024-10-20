<?php

namespace App\Http\Controllers\Builds;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Motherboard;
USE App\Models\Cpu;
use App\Models\Ram;
use App\Models\Gpu;
use App\Models\Storage;

class buildcompatability extends Controller
{
    // Fetch CPUs compatible with the selected motherboard
    public function getCompatibleCpus($motherboardId)
    {
        $motherboard = DB::table('motherboards')->find($motherboardId);

        if (!$motherboard) {
            return response()->json(['error' => 'Motherboard not found'], 404);
        }

        return response()->json(DB::table('cpus')->where('socket', $motherboard->socket)->get());
    }

    // Fetch all GPUs compatible with the motherboard
    public function getCompatibleGpus($motherboardId)
    {
        $motherboard = DB::table('motherboards')->find($motherboardId);

        if (!$motherboard) {
            return response()->json(['error' => 'Motherboard not found'], 404);
        }

        return response()->json(DB::table('gpus')->where('pcie_slots_required', '<=', $motherboard->pcie_slots)->get());
    }

    // Fetch all RAMs compatible with the motherboard
    public function getCompatibleRams($motherboardId)
    {
        $motherboard = DB::table('motherboards')->find($motherboardId);

        if (!$motherboard) {
            return response()->json(['error' => 'Motherboard not found'], 404);
        }

        return response()->json(DB::table('rams')
            ->where('ram_generation', $motherboard->ram_generation)
            ->where('speed_ddr_version', '<=', $motherboard->max_memory)
            ->get());
    }

    // Fetch all Storage devices compatible with the motherboard
    public function getCompatibleStorages($motherboardId)
    {
        $motherboard = DB::table('motherboards')->find($motherboardId);

        if (!$motherboard) {
            return response()->json(['error' => 'Motherboard not found'], 404);
        }

        $interfaces = explode(',', $motherboard->storage_interface);
        $query = DB::table('storages');

        foreach ($interfaces as $interface) {
            $query->orWhere('interface', 'LIKE', '%' . trim($interface) . '%');
        }

        return response()->json($query->get());
    }

    // Fetch all Computer Cases compatible with the motherboard
    public function getCompatibleCases($motherboardId, $gpuId)
    {
        // Fetch the motherboard and GPU information
        $motherboard = DB::table('motherboards')->find($motherboardId);
        $gpu = DB::table('gpus')->find($gpuId);

        // Check if the motherboard exists
        if (!$motherboard) {
            return response()->json(['error' => 'Motherboard not found'], 404);
        }

        // Check if the GPU exists
        if (!$gpu) {
            return response()->json(['error' => 'GPU not found'], 404);
        }

        // Fetch compatible cases based on form factor and GPU length limit
        $compatibleCases = DB::table('computer_cases')
            ->where('form_factor', $motherboard->form_factor)
            ->where('gpu_length_limit', '>=', $gpu->length) // Ensure GPU length is within the case's limit
            ->get();

        return response()->json($compatibleCases);
    }



    // Fetch all Power Supplies compatible with the build
    public function getCompatiblePowerSupplies(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'cpu_id' => 'required|integer',
            'gpu_id' => 'required|integer',
            'ram_id' => 'required|integer',
            'storage_id' => 'required|integer',
            'motherboard_id' => 'required|integer',
        ]);

        // Fetch the TDP values of the selected components
        $cpuTdp = DB::table('cpus')->where('id', $request->cpu_id)->value('tdp');
        $gpuTdp = DB::table('gpus')->where('id', $request->gpu_id)->value('tdp');
        $ramTdp = DB::table('rams')->where('id', $request->ram_id)->value('tdp'); // Ensure you have TDP in RAM table
        $storageTdp = DB::table('storages')->where('id', $request->storage_id)->value('tdp'); // Ensure you have TDP in Storage table

        // Calculate total TDP
        $totalTdp = ($cpuTdp ?: 0) + ($gpuTdp ?: 0) + ($ramTdp ?: 0) + ($storageTdp ?: 0);

        // Fetch compatible power supplies
        return response()->json(DB::table('power_supplies')->where('max_tdp', '>=', $totalTdp)->get());
    }
}
