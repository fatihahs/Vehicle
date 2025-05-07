<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Resident\ResidentController;
use App\Http\Controllers\Resident\VehicleLogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admins\AdminsController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/registeredResident', [ResidentController::class, 'index'])->name('residentlist');

Route::get('/vehicle-log', [VehicleLogController::class, 'index'])->name('vehicleLog');

//search
Route::get('/residents/search', [ResidentController::class, 'search'])->name('search.residents');

//ADMIN

//login
Route::get('admin/login', [AdminsController::class,'viewLogin'])->name('view.login')->middleware('checkforauth'); // we use middleware to prevent after login cannot access the login page (kernel,middleware files)
Route::post('admin/login', [AdminsController::class,'checkLogin'])->name('check.login');

//to protect, doesn't user access index page unless login
Route::group(["prefix" => "admin","middleware" => "auth:admin"], function (){

//dasboard
Route::get('dashboard', [AdminsController::class,'index'])->name('admins.dashboard');

//admin detail
Route::get('all-admins', [AdminsController::class,'allAdmins'])->name('admins.all');
//create admin
Route::get('admins-create', [AdminsController::class,'createAdmins'])->name('admins.create');
Route::post('admins-create', [AdminsController::class,'storeAdmins'])->name('admins.store');

//resident list
Route::get('all-residents', [AdminsController::class,'allResidents'])->name('all.residents');
Route::get('/admin/residents/search', [AdminsController::class, 'searchRegisterResident'])->name('search.register.resident'); // search
Route::post('/residents', [AdminsController::class, 'store'])->name('residents.store'); // register
Route::get('admins/residents/create', [AdminsController::class,'createResidents'])->name('admins.residents');
Route::resource('residents', AdminsController::class);  //to made changes

//show security/user list
Route::get('all-guards', [AdminsController::class,'allGuards'])->name('all.guards');


});
