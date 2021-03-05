<?php

namespace App\Http\Controllers;

use App\Models\SubSector;
use Illuminate\Http\Request;

class SubSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(SubSector::orderBy('name', 'ASC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show($sector)
    {
        $sector = SubSector::whereSlug($sector)->firstOrFail();
        $p = $sector->companies->filter(function ($value, $key) {
            if (count($value->posts) <= 0) {
                return false;
            }
            foreach ($value->posts as $post) {
                if ($post->promote != null) {
                    return true;
                }
            }
            return false;
        });
        $sector->companies = $p->take(40);
        return response()->json($sector);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubSector  $subSector
     * @return \Illuminate\Http\Response
     */
    public function edit(SubSector $subSector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubSector  $subSector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubSector $subSector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubSector  $subSector
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubSector $subSector)
    {
        //
    }
}
