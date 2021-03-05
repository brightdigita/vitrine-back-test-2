<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'company' => ['required', 'exists:companies,id']
        ]);

        $company = Company::find($request->company);

        auth()->user()->company->befriend($company);

        return response()->json();
    }

    public function accept(Request $request)
    {
        $request->validate([
            'company' => ['required', 'exists:companies,id']
        ]);

        $company = Company::find($request->company);

        auth()->user()->company->acceptFriendRequest($company);

        return response()->json();
    }

    public function deny(Request $request)
    {
        $request->validate([
            'company' => ['required', 'exists:companies,id']
        ]);

        $company = Company::find($request->company);

        auth()->user()->company->denyFriendRequest($company);

        return response()->json();
    }

    public function index()
    {
        return response()->json(auth()->user()->company->getAllFriendships());
    }

    public function unfreind(Request $request)
    {
        $request->validate([
            'company' => ['required', 'exists:companies,id']
        ]);

        $company = Company::find($request->company);

        auth()->user()->company->unfriend($company);

        return response()->json();
    }
}
