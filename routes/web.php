<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Country Routes
    Route::get("/country", [AdminController::class, 'showCountryPage'])->name('country.index');
    Route::post("/country", [AdminController::class, 'storeCountry'])->name('country.store');

    //City Routes
    Route::get("/city", [AdminController::class, 'showCityPage'])->name('city.index');
    Route::post("/city", [AdminController::class, 'storeCity'])->name('city.store');

    //City Routes
    Route::get("/population", [AdminController::class, 'showPopulationPage'])->name('population.index');
    Route::post("/population", [AdminController::class, 'storePopulation'])->name('population.store');
});

require __DIR__ . '/auth.php';
