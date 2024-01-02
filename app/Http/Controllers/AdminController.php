<?php

namespace App\Http\Controllers;

use App\Models\City;
use Inertia\Inertia;
use App\Models\Country;
use App\Models\Population;
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

    public function showCityPage()
    {
        $countries = Country::all();
        return Inertia::render('City/index', [
            'countries' => $countries,
        ]);
    }

    public function storeCity(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required',
            'city' => 'required|min:2',
        ]);

        $newCity = City::create([
            'country_id' => $request->country_id,
            'city' => $request->city,
        ]);

        return redirect()->route('city.index')->with('message', 'City saved successfully!');
    }

    public function showPopulationPage()
    {
        $countries = Country::with('cities')->get();
        return Inertia::render('Population/index', [
            'countries' => $countries,
        ]);
    }

    public function storePopulation(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required',
            'city_id' => 'required',
            'age_group' => 'required',
            'male_population' => 'required',
            'female_population' => 'required',
        ]);

        $newPopulation = Population::create([
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'age_group' => $request->age_group,
            'male_population' => $request->male_population,
            'female_population' => $request->female_population,
        ]);

        return redirect()->route('population.index')->with('message', 'Population recorded successfully!');
    }
}
