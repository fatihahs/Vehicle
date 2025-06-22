<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\Resident\Resident;
use App\Models\Resident\VehicleLog;
use App\Http\Controllers\Resident\VehicleLogController;
use App\Http\Controllers\Resident\Dashboardcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//RFID
Route::post('/rfid', function (Request $request){

    $validated = $request->validate([
        'tag_id' => 'required|string'
    ]);

    $tag = strtoupper($validated['tag_id']);
    Log::info('RFID Tag Received: '.$tag);

    $resident = Resident::where('TagID', $tag)->first();

    if (!$resident){
        Log::warning('Unauthorized Vehicle');

        Cache::put('latest_rfid_result',[
            'authorized' => false,
            'Name' => 'UNKNOWN',
            'PlateNo' => '-',
            'Address' => '-',
            'status' => '-'
        ], now()->addSeconds(30));

        return response()->json([
            'status' => 'fail',
            'message' => 'Unauthorized Vehicle'
        ],404);
    }

    DB::beginTransaction();
    try{

        $prestatus = VehicleLog::where('ResidentID', $resident->id)->latest('created_at')->first(); //check log last status

        //condition status
        if(!$prestatus || $prestatus->status === 'OUT'){
            $status = 'IN';
        }
        else{
            $status = 'OUT';
        }

        //create vehicle log
        VehicleLog::create([
            'ResidentID' => $resident->id,
            'status' => $status
        ]);

        DB::commit();

        Cache::put('latest_rfid_result', [
            'authorized' => true,
            'Name' => $resident->Name,
            'PlateNo' => $resident->PlateNo,
            'Address' => $resident->Address,
            'status' => $status
        ], now()->addSeconds(30));

        return response()->json([
            'status' => 'success',
            'message' => 'Tag matched.',
            'resident' => $resident->Name
        ]);

    }catch (\Exception $e){
        DB::rollBack();
        Log::error('RFID failed: '.$e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to process'
        ],500);
    }
});


Route::get('/rfid/latest', function (){
    $data = Cache::get('latest_rfid_result');
    return response()->json($data);
});

//MOTION
Route::post('/motion', function (Request $request){
    $motion = $request->input('motion');

    if($motion == '1'){
        Log::info('Motion Detected');

        Cache::put('motion_status', true,30); //store for15s

        return response()->json([
            'status' => 'success',
            'message' => 'Motion Detected',
            'motion' => true
        ]);
    }

});

Route::get('/motion-status',function(){
    $motion = Cache::get('motion_status', false);
    return response()->json(['motion' => $motion]);
});

Route::get('/vehicle-status',[DashboardController::class,'vehicleStatus']);


//search
Route::get('/logs/search', [VehicleLogController::class, 'search']);



