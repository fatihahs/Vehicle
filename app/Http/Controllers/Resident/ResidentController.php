<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resident\Resident;

class ResidentController extends Controller
{
    public function index(){
        // display registered resident
        $residents = Resident::paginate(7);
        return view('residentlist', compact('residents'));
    }

    public function search(Request $request)
    {
    $query = Resident::query();

    if ($request->has('search')) {
        $searchTerm = $request->input('search');

        // Filter by name, license plate, and address
        $query->where(function($query) use ($searchTerm) {
            $query->where('Name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('PlateNo', 'like', '%' . $searchTerm . '%')
                  ->orWhere('Address', 'like', '%' . $searchTerm . '%');
        });
    }

    // Get the filtered residents
    $residents = $query->paginate(7)->appends($request->query());

    return view('residentlist', compact('residents'));
    }

}
