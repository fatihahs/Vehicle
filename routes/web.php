<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Resident\DashboardController;
use App\Http\Controllers\Resident\ResidentController;
use App\Http\Controllers\Resident\VehicleLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Admins\ResidentsController;
use App\Http\Controllers\Admins\GuardsController;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Cache;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();


Route::get('/dashboard', function () {
    return view('dashboard');
});

//HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/motion-status', function () {                  //check status
    return response()->json([
        'motion' => Cache::get('motion_status', false)
    ]);
});

Route::get('/registeredResident', [ResidentController::class, 'index'])->name('residentlist');
Route::get('/vehicle-log', [VehicleLogController::class, 'index'])->name('vehicleLog');

//search
Route::get('/residents/search', [ResidentController::class, 'search'])->name('search.residents');


//****  ADMIN ****//

//login
Route::get('admin/login', [AdminsController::class,'viewLogin'])->name('view.login')->middleware('checkforauth'); // we use middleware to prevent after login cannot access the login page (kernel,middleware files)
Route::post('admin/login', [AdminsController::class,'checkLogin'])->name('check.login');

//to protect, doesn't user access index page unless login
Route::group(["prefix" => "admin","middleware" => "auth:admin"], function (){

//dasboard
Route::get('dashboard', [AdminsController::class,'index'])->name('admins.dashboard');

//admin
Route::get('all-admins', [AdminsController::class,'allAdmins'])->name('admins.all'); //display
Route::get('/admin/admins/search', [AdminsController::class, 'searchAdmins'])->name('search.admins'); // search
Route::get('admins-admins', [AdminsController::class,'createAdmins'])->name('admins.admins');//register
Route::post('admins-admins', [AdminsController::class,'storeAdmins'])->name('admins.store'); //store new admin
Route::resource('admins', AdminsController::class);  //to made changes

//resident list
Route::get('all-residents', [ResidentsController::class,'allResidents'])->name('all.residents');
Route::get('/admin/residents/search', [ResidentsController::class, 'searchRegisterResident'])->name('search.register.resident'); // search
Route::post('/residents', [ResidentsController::class, 'store'])->name('residents.store'); // register
Route::get('admins/residents/create', [ResidentsController::class,'createResidents'])->name('admins.residents');
Route::resource('residents', ResidentsController::class);  //to made changes

//security/user list
Route::get('all-guards', [GuardsController::class,'allGuards'])->name('all.guards');
Route::get('/admin/guards/search', [GuardsController::class, 'searchGuards'])->name('search.guards'); // search
Route::post('/guards/create', [GuardsController::class, 'store'])->name('guards.store'); // register
Route::get('admins/guards/create', [GuardsController::class,'createGuards'])->name('admins.create');
Route::resource('guards', GuardsController::class);  //to made changes


});
