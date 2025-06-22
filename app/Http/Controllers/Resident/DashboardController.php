<?php

namespace App\Http\Controllers\Resident;
use App\Http\Controllers\Controller;
use App\Models\Resident\VehicleLog;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function vehicleStatus()
    {
        $status = VehicleLog::select('ResidentID', //
            DB::raw('Max(id) as latest_id'))
                ->groupBy('ResidentID');

        $log = VehicleLog::joinSub($status, 'logs', function ($join){
            $join->on('vehicle_log.id', '=', 'logs.latest_id');
        })->get();

        $inCount = $log->where('status', 'IN')->count();
        $outCount = $log->where('status', 'OUT')->count();


        return response()->json([
            'IN' => $inCount,
            'OUT' => $outCount,
        ]);
    }
}
