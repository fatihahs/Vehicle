<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident\Resident;
use App\Models\Admin\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\ActivityLog;

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
        $activities = ActivityLog::latest()->take(3)->get();
        return view("admins.dashboard", compact('residentCount', 'adminCount', 'guardCount', 'activities'));
    }


    //to display admin info
    public function allAdmins(){
        $admins = Admin::select()->orderBy('id', 'desc')->paginate(7);
        return view("admins.alladmins", compact('admins'));
    }

    //to add admin
    public function createAdmins(){
        return view("admins.createadmins");
    }

    public function searchAdmins(Request $request)
    {
         $query = Admin::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');

         $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                 ->orWhere('email', 'like', '%' . $searchTerm . '%');
             });
         }

    $admins = $query->paginate(7)->appends($request->query());

    return view('admins.alladmins', compact('admins'));
    }

    //to save admin
    public function store(Request $request){

        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|max:40",
            "password" => "required|min:6|confirmed",

        ]);


        $admins = Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            "password"=> Hash::make($request->password),
        ]);

        if($admins){

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => $request->name . ' was added as admin by ' . auth('admin')->user()->name,
        ]);

            return redirect()->route('admins.all')->with(['success' => 'Registered successfully.']);
        }

    }

    public function edit($id) // update page
    {
        $admin = Admin::findOrFail($id);
        return view('admins.editAdmin', compact('admin'));

    }

    public function update(Request $request, $id) // to update
    {
        $admins = Admin::findOrFail($id);
        $request->validate([
        'name' => 'nullable|max:40',
        'email' => 'nullable|email:filter|max:40',
        // optional/if blank, save old pass
        'old_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:8|confirmed',
    ]);

        //if fill,update
        if ($request->filled('name')) {
            $admins->name = $request->name;
        }

        if ($request->filled('email')) {
            $admins->email = $request->email;
        }

        // Check
        if ($request->filled('old_password') || $request->filled('new_password')) {

            // condition/ fill both to change pass
            if (!$request->filled('old_password') || !$request->filled('new_password')) {
                return redirect()->back()->withErrors(['password' => 'Both old password and new password are required to change password.'])->withInput();
            }

            // Verify old pass
            if (!Hash::check($request->old_password, $admins->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Old password is incorrect'])->withInput();
            }

            $admins->password = Hash::make($request->new_password);
        }

        $admins->save();

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => "Admin {$admins->name}'s details was updated by " . auth('admin')->user()->name,
        ]);
        return redirect()->route('admins.all')->with('success', 'Updated successfully');
    }

    public function destroy($id) // to delete
    {
        $admins = Admin::findOrFail($id);
        $admins->delete();

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => "Admin {$admins->name}'s detail was deleted by " . auth('admin')->user()->name,
        ]);

        return redirect()->route('admins.all')->with('success', 'Deleted successfully');
    }
}
