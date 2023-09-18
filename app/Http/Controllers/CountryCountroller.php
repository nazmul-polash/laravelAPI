<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryCountroller extends Controller
{
    public function store(Request $request){
        $isExist = Country::where('country_name',$request->country_name)->exists();
        if($isExist){
            return response()->json(['success' => true,]);
        }
        $country = new Country();
        $country->country_name = $request->country_name;
        $country->save();
        return response()->json(['success' => true]);

    }

    public function city_store(Request $request){
        $cities = City::where('ref_country_id', $request->country_id)->get();
        $html = view('ajax.city',compact('cities'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    public function get_area(Request $request){
        $areas = Area::where('ref_country_id', $request->city_id)->get();
        $html = view('ajax.area',compact('areas'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
}
