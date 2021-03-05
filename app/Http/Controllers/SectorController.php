<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Sector::with('subSectors')->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popular()
    {
        return response()->json(Sector::with('subSectors')->limit(12)->get());
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show($sector)
    {
        $sector = Sector::whereSlug($sector)->firstOrFail();
        $popular = collect([]);
        foreach ($sector->subSectors as $sub_sector) {
            foreach ($sub_sector->companies as $company) {
                $popular->add($company);
            }
        }
        $p = $popular->filter(function ($value, $key) {
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
        $sector->companies = $p->take(8);
        return response()->json($sector);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function showCompanies($sector)
    {
        $sector = Sector::whereSlug($sector)->firstOrFail();
        $popular = collect([]);
        foreach ($sector->subSectors as $sub_sector) {
            foreach ($sub_sector->companies as $company) {
                $popular->add($company);
            }
        }
        return response()->json($popular);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        //
    }
}
