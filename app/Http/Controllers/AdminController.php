<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Country;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showCountryPage()
    {
        return Inertia::render('Country/index');
    }

    public function storeCountry(Request $request)
    {
        $validated = $request->validate([
            'country' => 'required|min:2',
        ]);

        $newCountry = Country::create([
            'country' => $request->country
        ]);

        return redirect()->route('country.index')->with('message', 'Country saved successfully!');
    }

    public function viewCityPage()
    {
        //
    }

    public function storeCity()
    {
        //
    }

    public function viewPopulationPage()
    {
        //
    }

    public function storePopulation()
    {
        //
    }
}
