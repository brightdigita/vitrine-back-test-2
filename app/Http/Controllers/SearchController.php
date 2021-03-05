<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Sector;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $city = City::whereSlug($request->city)->orWhere('name', $request->q)->first();
        if ($city) {
            $companies = Company::where('name', 'LIKE', "%{$request->q}%")->orWhere('city_id', $city->id)->get();
        } else {
            $companies = Company::where('name', 'LIKE', "%{$request->q}%")->get();
        }

        $cities = City::where('name', 'LIKE', "%{$request->q}%")->get();
        $sectors = Sector::where('name', 'LIKE', "%{$request->q}%")->get();

        return response()->json(compact('cities', 'sectors', 'companies'));
    }
}
