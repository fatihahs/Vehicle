<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident\VehicleLog;

class VehicleLogController extends Controller
{
    public function index()
    {
        $logs = VehicleLog::latest()->get();
        return view('vehicle_log', compact('logs'));
    }

    public function search(Request $request){
        $name = $request->input('name');
        $date = $request->input('date');

        $query = VehicleLog::query();

        if ($name) {
        $query->where(function ($q) use ($name) {
            $q->where('Name', 'like', "%$name%")
              ->orWhere('PlateNo', 'like', "%$name%");
        });
    }
    if ($date) {
        $query->whereDate('created_at', $date);
    }

    $logs = $query->get();

    return response()->json($logs);
    }
}
