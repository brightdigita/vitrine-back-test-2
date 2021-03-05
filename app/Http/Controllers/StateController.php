<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        return response()->json(State::all());
    }

    public function popular()
    {
        return response()->json(State::take(6)->get());
    }

    public function show($slug)
    {

        $state = State::whereCode($slug)->firstOrFail();
        $state->companies = $state->popularCompanies();
        return response()->json($state);
    }

    public function companies($slug)
    {

        $state = State::whereCode($slug)->firstOrFail();
        return response()->json($state->popularCompanies());
    }
}
