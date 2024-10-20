<?php
namespace App\Http\Controllers\Admin\AdminControl;


use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;

class ActivityLogController extends AdminController
{
    // Fetch all activity logs
    public function fetchActivityLogs(): JsonResponse
    {
        $logs = $this->getActivityLogs();
        return response()->json($logs);
    }

    // Fetch user-specific activity logs
    public function fetchUserActivityLogs($id): JsonResponse
    {
        $userlogs = ActivityLog::where('user_id', $id)->get();
        return response()->json($userlogs);
    }

    // Private method to fetch logs from the database
    private function getActivityLogs(): \Illuminate\Support\Collection
    {
        return DB::table('activity_logs as al')
            ->join('users as u', 'al.user_id', '=', 'u.id')
            ->select('al.activity_timestamp', 'al.activity', 'u.name')
            ->orderBy('al.created_at', 'DESC')
            ->get();
    }
}
