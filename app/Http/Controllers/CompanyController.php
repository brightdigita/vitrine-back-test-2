<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $companies = Company::all();
        $companies = $companies->filter(function ($value, $key) {
            return $value->active_subscription != null;
        });
        return response()->json($companies->paginate(20)); */

        return response()->json(Company::paginate(20));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function latest()
    {
        /* $companies = Company::all();
        $companies = $companies->filter(function ($value, $key) {
            return $value->active_subscription != null;
        });
        return response()->json($companies->paginate(20)); */

        return response()->json(Company::latest()->limit(20)->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trending()
    {
        $companies = Company::all();
        $companies = $companies->sortBy([
            ['views', 'desc'],
            ['name', 'asc'],
        ]);
        /* $companies = $companies->filter(function ($value, $key) {
            return $value->active_subscription != null;
        }); */
        return response()->json($companies->take(20));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function popular()
    {
        $companies = Company::all();
        $companies = $companies->filter(function ($value, $key) {
            if (count($value->posts) <= 0) {
                return false;
            }
            foreach ($value->posts as $post) {
                if ($post->promote != null) {
                    return true;
                }
            }
            return $value->active_subscription != null;
        });
        return response()->json($companies->paginate(20));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return response()->json(Company::paginate(20));
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
        $request->validate([
            "name" => ["required", 'min:3'],
            "about" => ["required", "min:20"],
            "email" => ["nullable", "email"],
            "phone" => ["nullable", "phone:AUTO,CM"],
            "phone2" => ["nullable", "phone:AUTO,CM"],
            "city" => ["required", "exists:cities,slug"],
            "sub_sector" => ["required", "exists:sub_sectors,id"],
            "town" => ["required"],
            "facebook_url" => ["nullable", "url"],
            "twitter_url" => ["nullable", "url"],
            "instagram_url" => ["nullable", "url"],
            "youtube_url" => ["nullable", "url"],
            "linkedin_url" => ["nullable", "url"],
            "zip_code" => ["nullable"],
        ]);

        /* if (auth()->user()->hasAnyRole(['admin', 'super-admin'])) {
            $company = Company::create([
                "name" => $request->name,
                "about" => $request->about,
                "phone2" => $request->phone2,
                "phone" => $request->phone,
                "city_id" => City::whereSlug($request->city)->first()->id,
                "town" => $request->town,
                "email" => $request->email,
                'sub_sector_id' => $request->sub_sector,
                "website" => $request->website,
                "facebook_url" => $request->facebook_url,
                "instagram_url" => $request->instagram_url,
                "linkedin_url" => $request->linkedin_url,
                "twitter_url" => $request->twitter_url,
                "lat" => $request->lat,
                "lng" => $request->lng,
                "landmark" => $request->landmark,
                "slug" => Company::slug($request->name)
            ]);
        } else {

        } */

        if (Company::whereUserId(auth()->id())->first()) {
            abort(412);
        }

        $company = auth()->user()->company()->create([
            "name" => $request->name,
            "about" => $request->about,
            "phone2" => $request->phone2,
            "phone" => $request->phone,
            "city_id" => City::whereSlug($request->city)->first()->id,
            "town" => $request->town,
            "email" => $request->email,
            "website" => $request->website,
            "facebook_url" => $request->facebook_url,
            "instagram_url" => $request->instagram_url,
            "linkedin_url" => $request->linkedin_url,
            "twitter_url" => $request->twitter_url,
            "lat" => $request->lat,
            "lng" => $request->lng,
            "landmark" => $request->landmark,
            "slug" => Company::slug($request->name),
            'sub_sector_id' => $request->sub_sector
        ]);
        return response()->json($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($company)
    {
        $company = Company::whereSlug($company)->firstOrFail();
        $company->opens()->create();
        return response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function message(Request $request, $company)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone:CM,AUTO'],
            'content' => ['required', 'min:20'],
        ]);

        $company = Company::whereSlug($company)->firstOrFail();
        $company->messages()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'content' => $request->content,
        ]);

        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            "name" => ["required", 'min:3'],
            "about" => ["required", "min:20"],
            "email" => ["nullable", "email"],
            "phone" => ["nullable", "phone:AUTO,CM"],
            "phone2" => ["nullable", "phone:AUTO,CM"],
            "city" => ["required", "exists:cities,slug"],
            "sub_sector" => ["required", "exists:sub_sectors,id"],
            "town" => ["required"],
            "facebook_url" => ["nullable", "url"],
            "twitter_url" => ["nullable", "url"],
            "instagram_url" => ["nullable", "url"],
            "youtube_url" => ["nullable", "url"],
            "linkedin_url" => ["nullable", "url"],
            "zip_code" => ["nullable"],
        ]);

        $company = auth()->user()->company;

        $company->name = $request->name;
        $company->about = $request->about;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->phone2 = $request->phone2;
        $company->city_id = City::whereSlug($request->city)->first()->id;
        $company->sub_sector_id = $request->sub_sector;
        $company->town = $request->town;
        $company->facebook_url = $request->facebook_url;
        $company->twitter_url = $request->twitter_url;
        $company->instagram_url = $request->instagram_url;
        $company->youtube_url = $request->youtube_url;
        $company->linkedin_url = $request->linkedin_url;
        $company->zip_code = $request->zip_code;

        $company->save();

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
