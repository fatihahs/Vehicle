<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident\Resident;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function viewLogin(){
        return view('admins.login');
    }

    public function checkLogin(Request $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect() -> route('admins.dashboard'); //if match, go here (route)
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    //go to dashboard
    public function index(){

        // counter
        $residentCount = Resident::select()->count();
        $adminCount = Admin::select()->count();
        $guardCount = User::select()->count();

        return view("admins.dashboard", compact('residentCount', 'adminCount', 'guardCount'));
    }

    //to display admin info
    public function allAdmins(){
        $admins = Admin::select()->orderBy('id', 'desc')->get();
        return view("admins.alladmins", compact('admins'));
    }

    //to add admin
    public function createAdmins(){
        return view("admins.createadmins");
    }

    //to save admin
    public function storeAdmins(Request $request){

        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|max:40",
            "password" => "required|max:50",

        ]);


        $admins = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password"=> Hash::make($request->password),
        ]);

        if($admins){
            return redirect()->route('admins.all')->with(['success' => 'Admin created successfully']);
        }

    }

    // display residents detail
    public function allResidents(){
        $residents = Resident::select()->orderBy('id', 'desc')->get();
        return view("admins.allResidents", compact('residents'));
    }


    //display user detail
    public function allGuards(){
        $guards = User::select()->orderBy('id', 'desc')->get();
        return view("admins.allGuards", compact('guards'));
    }

    //to add admin
    public function createResidents(){
        return view("admins.createresidents");
    }


    // RESIDENT PAGE

    public function searchRegisterResident(Request $request)
    {
        $query = Resident::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            $query->where(function($q) use ($searchTerm) {
                $q->where('Name', 'like', '%' . $searchTerm . '%')
                ->orWhere('PlateNo', 'like', '%' . $searchTerm . '%')
                ->orWhere('Address', 'like', '%' . $searchTerm . '%')
                ->orWhere('Phone', 'like', '%' . $searchTerm . '%');
            });
        }

    $residents = $query->get();

    return view('admins.allresidents', compact('residents'));
}


    public function store(Request $request)  //register resident
    {
        $request->validate([
            'TagID' => 'required|unique:residents',
            'Name' => 'required|string|max:255',
            'PlateNo' => 'required|string|max:20',
            'Phone' => 'required|string|max:15',
            'Address' => 'required|string',
        ]);

        Resident::create($request->all());

        return redirect()->route('all.residents')->with('success', 'Resident registered successfully.');
    }


    public function edit($id) // update page
    {
        $resident = Resident::findOrFail($id);
        return view('admins.edit', compact('resident'));

    }

    public function update(Request $request, $id) // to update
    {
        $resident = Resident::findOrFail($id);
        $resident->update($request->all());

        return redirect()->route('all.residents')->with('success', 'Resident updated successfully');
    }

    public function destroy($id) // to delete
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('all.residents')->with('success', 'Resident deleted successfully');
    }



}
