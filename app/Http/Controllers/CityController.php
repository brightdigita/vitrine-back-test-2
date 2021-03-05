<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return response()->json(City::orderBy('name', 'ASC')->get());
    }

    public function find(Request $request)
    {
        return response()->json(City::with('state')
            ->where('name', 'LIKE', "%{$request->q}%")->get());
    }
}
