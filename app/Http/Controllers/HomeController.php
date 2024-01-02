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
            ->select(DB::raw('countries.country as country_name,SUM(male_population + female_population) AS total_population'))
            ->join('countries', 'countries.id', '=', 'populations.country_id')
            ->groupBy('populations.country_id')
            ->groupBy('countries.country')
            ->orderBy('total_population', 'desc')
            ->limit(3);

        $countries = Country::with('cities');

        $countryFilter = $request->input('country_id');
        $cityFilter = $request->input('city_id');
        $gender_population = $request->input('gender_population');

        $query = DB::table('populations')
            ->when($countryFilter, function ($query) use ($countryFilter) {
                return $query->where('country_id', $countryFilter);
            })
            ->when($cityFilter, function ($query) use ($cityFilter) {
                return $query->where('city_id', $cityFilter);
            });

        // Conditionally add the population column based on gender
        $populationColumn = match ($gender_population) {
            'Male'   => DB::raw('populations.age_group,SUM(male_population) AS total_population'),
            'Female' => DB::raw('populations.age_group,SUM(female_population) AS total_population'),
            default  => DB::raw('populations.age_group,SUM(male_population + female_population) AS total_population'),
        };

        $ageGroupStats = $query->select($populationColumn)->groupBy('populations.age_group');

        return Inertia::render('Home/index', [
            'highestCoutriesByPopulation' => fn () => $highestCoutriesByPopulation->get(),
            'countries' => fn () => $countries->get(),
            'ageGroupStats' => fn () => $ageGroupStats->get(),
        ]);
    }
}
