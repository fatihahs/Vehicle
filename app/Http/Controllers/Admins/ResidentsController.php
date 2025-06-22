<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident\Resident;
use App\Models\Admin\ActivityLog;

class ResidentsController extends Controller
{
    // display residents detail
    public function allResidents(){
        $residents = Resident::select()->orderBy('id', 'desc')->paginate(7);
        return view("admins.allResidents", compact('residents'));
    }


    //to add residents
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

    $residents = $query->paginate(7)->appends($request->query());

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

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => $request->Name . ' was added as resident by ' . auth('admin')->user()->name,
        ]);

        return redirect()->route('all.residents')->with('success', 'Resident registered successfully.');
    }


    public function edit($id) // update page
    {
        $resident = Resident::findOrFail($id);
        return view('admins.editResident', compact('resident'));

    }

    public function update(Request $request, $id) // to update
    {
        $resident = Resident::findOrFail($id);
        $resident->update($request->all());

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => "Resident {$resident->Name}'s details was updated by " . auth('admin')->user()->name,
        ]);

        return redirect()->route('all.residents')->with('success', 'Resident updated successfully');
    }

    public function destroy($id) // to delete
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => "Resident {$resident->Name} was deleted by " . auth('admin')->user()->name,
        ]);

        return redirect()->route('all.residents')->with('success', 'Resident deleted successfully');
    }
}
