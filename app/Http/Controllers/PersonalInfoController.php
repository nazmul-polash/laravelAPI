<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

use App\Http\Controllers\Controller;

class PersonalInfoController extends Controller
{
    public function create(Request $request)
    {
        $countries = Country::all();
        $cities = City::all();
        return view('task.create',compact('countries','cities'));
    }

    public function designation_search(Request $request)
    {
        $searchTerm = $request->input('term');
        $results = Designation::where('designation_name', 'LIKE', '%' . $searchTerm . '%')
            ->pluck('designation_name');
        return response()->json($results);
    }

    public function store(Request $request){
        dd($request->all());
    }

 
}
