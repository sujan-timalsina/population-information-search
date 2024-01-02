<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Country;
use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $highestCoutriesByPopulation = DB::table('populations')
            ->select(DB::raw('populations.id, countries.country as country_name,SUM(male_population + female_population) AS total_population'))
            ->join('countries', 'countries.id', '=', 'populations.country_id')
            ->groupBy('populations.country_id')
            ->groupBy('countries.country')
            ->groupBy('populations.id')
            ->orderBy('total_population', 'desc')
            ->limit(3)
            ->get();

        $countries = Country::with('cities')->get();

        $countryFilter = $request->input('country_id');
        $cityFilter = $request->input('city_id');
        $gender_population = $request->input('gender_population');

        if ($gender_population == 'Male') {
            $ageGroupstats = DB::table('populations')
                ->select(DB::raw('populations.age_group, SUM(male_population) AS total_population'))
                ->when($countryFilter, function ($query) use ($countryFilter) {
                    return $query->where('country_id', $countryFilter);
                })
                ->when($cityFilter, function ($query) use ($cityFilter) {
                    return $query->where('city_id', $cityFilter);
                })
                ->groupBy('populations.age_group')
                ->get();
        } else if ($gender_population == 'Female') {
            $ageGroupstats = DB::table('populations')
                ->select(DB::raw('populations.age_group, SUM(female_population) AS total_population'))
                ->when($countryFilter, function ($query) use ($countryFilter) {
                    return $query->where('country_id', $countryFilter);
                })
                ->when($cityFilter, function ($query) use ($cityFilter) {
                    return $query->where('city_id', $cityFilter);
                })
                ->groupBy('populations.age_group')
                ->get();
        } else {
            $ageGroupstats = DB::table('populations')
                ->select(DB::raw('populations.age_group, SUM(male_population + female_population) AS total_population'))
                ->when($countryFilter, function ($query) use ($countryFilter) {
                    return $query->where('country_id', $countryFilter);
                })
                ->when($cityFilter, function ($query) use ($cityFilter) {
                    return $query->where('city_id', $cityFilter);
                })
                ->groupBy('populations.age_group')
                ->get();
        }

        return Inertia::render('Home/index', [
            'highestCoutriesByPopulation' => $highestCoutriesByPopulation,
            'countries' => $countries,
            'ageGroupstats' => $ageGroupstats
        ]);
    }
}
