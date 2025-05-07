<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Resident\Resident;
use App\Models\Resident\VehicleLog;
use App\Http\Controllers\Resident\VehicleLogController;
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

//******** VEHICLE LOG  *********/
//receive from arduino
// Route::post('/rfid', function (Request $request){
//     $tag = strtoupper($request->tag_id); // Ensure uppercase for matching
//     Log::info('RFID Tag Received: ' . $tag);

//     $resident = Resident::where('TagID', $tag)->first();

//     if ($resident) {
//         // Save log if match
//         VehicleLog::create([
//             'Name' => $resident->Name,
//             'TagID' => $resident->TagID,
//             'PlateNo' => $resident->PlateNo
//         ]);

//         return response()->json(['status' => 'success', 'message' => 'Tag matched and logged.']);
//     } else {
//         return response()->json(['status' => 'fail', 'message' => 'Tag not found.']);
//     }
// });

Route::post('/rfid', function (Request $request){

    $validated = $request->validate([
        'tag_id' => 'required|string'
    ]);

    $tag = strtoupper($validated['tag_id']);
    Log::info('RFID Tag Received: '.$tag);

    $resident = Resident::where('TagID', $tag)->first();

    if (!$resident){
        Log::warning('Unauthorized Vehicle');
        return response()->json([
            'status' => 'fail',
            'message' => 'Unauthorized Vehicle'
        ],404);
    }

    DB::beginTransaction();
    try{

        $prestatus = VehicleLog::where('TagID', $tag)->latest('created_at')->first(); //check log last status

        //condition status
        if(!$prestatus || $prestatus->status === 'OUT'){
            $status = 'IN';
        }
        else{
            $status = 'OUT';
        }

        //create vehicle log
        VehicleLog::create([
            'Name' => $resident->Name,
            'TagID' => $resident->TagID,
            'PlateNo' => $resident->PlateNo,
            'status' => $status
        ]);

        DB::commit();

        return response()->json([
            'status' => 'success',
            'message' => 'Tag matched.',
            'resident' => $resident->Name,
            'status_logged' => $status
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


//search
Route::get('/logs/search', [VehicleLogController::class, 'search']);



