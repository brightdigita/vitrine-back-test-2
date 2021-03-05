<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function poster(Request $request)
    {
        $request->validate([
            'file' => ["required", "image"]
        ]);

        $url = Storage::putFile('posters', $request->file('file'));

        $company = auth()->user()->company;

        $company->poster = $url;
        $company->save();
        return response()->json(Storage::disk(config("filesystems.default"))->url($url));
    }

    public function backdrop(Request $request)
    {
        $request->validate([
            'file' => ["required", "image"]
        ]);

        $url = Storage::putFile('backdrops', $request->file('file'));
        $company = auth()->user()->company;

        $company->backdrop = $url;
        $company->save();
        return response()->json(Storage::disk(config("filesystems.default"))->url($url));
    }

    public function post(Request $request)
    {
        $request->validate([
            'file' => ["required", "image"]
        ]);

        $url = Storage::putFile('posts', $request->file('file'));
        return response()->json([
            "path" => $url,
            'url' => Storage::disk(config("filesystems.default"))->url($url)
        ]);
    }
}
