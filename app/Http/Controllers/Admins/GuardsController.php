<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\ActivityLog;

class GuardsController extends Controller
{
    // display guards detail
    public function allGuards(){
        $guards = User::select()->orderBy('id', 'desc')->paginate(7);
        return view("admins.allGuards", compact('guards'));
    }


    //to add guards
    public function createGuards(){
        return view("admins.createguards");
    }



    public function searchGuards(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            });
        }

    $guards = $query->paginate(7)->appends($request->query());

    return view('admins.allguards', compact('guards'));
    }


    public function store(Request $request)  //register
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:20',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create($request->all());

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => $request->name . ' was added as security guard by ' . auth('admin')->user()->name,
        ]);

        return redirect()->route('all.guards')->with('success', 'Registered successfully.');
    }


    public function edit($id) // update page
    {
        $guard = User::findOrFail($id);
        return view('admins.editGuard', compact('guard'));

    }

    public function update(Request $request, $id) // to update
    {
        $guard = User::findOrFail($id);
        $request->validate([
        'name' => 'nullable|max:40',
        'email' => 'nullable|email:filter|max:40',
    ]);
        $guard->update($request->all());

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => "Guard {$guard->name }'s details was updated by " . auth('admin')->user()->name,
        ]);

        return redirect()->route('all.guards')->with('success', 'Updated successfully');
    }

    public function destroy($id) // to delete
    {
        $guard = User::findOrFail($id);
        $guard->delete();

        ActivityLog::create([
            'AdminID' => auth()->id(),
            'description' => "Guard {$guard->name} was deleted by " . auth('admin')->user()->name,
        ]);

        return redirect()->route('all.guards')->with('success', 'Deleted successfully');
    }
}
