<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident\VehicleLog;

class VehicleLogController extends Controller
{
    public function index()
    {
        $logs = VehicleLog::with('resident')->latest()->paginate(7);
        return view('vehicle_log', compact('logs'));
    }

    public function search(Request $request){
        $name = $request->input('name');
        $date = $request->input('date');

        $query = VehicleLog::with('resident');

        if ($name) {
        $query->whereHas('resident',function ($q) use ($name) {
            $q->where('Name', 'like', "%$name%")
              ->orWhere('PlateNo', 'like', "%$name%");
        });
    }
    if ($date) {
        $query->whereDate('created_at', $date);
    }

    $logs = $query->latest()->paginate(7);

    /** @var \Illuminate\Pagination\LengthAwarePaginator $logs */
    $logs->getCollection()->transform(function ($log){
          return [
            'id' => $log->id,
            'Name' => $log->resident->Name ?? 'UNKNOWN',
            'PlateNo' => $log->resident->PlateNo ?? '-',
            'created_at' => $log->created_at,
            'status' => $log->status,
        ];
        });
    return response()->json($logs);
    }

}
