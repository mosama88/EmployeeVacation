<?php

use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\HolidayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/







Route::middleware(['auth:admin', 'verified'])->name('dashboard.')->group(function () {

    Route::get('/', function () {
        return view('dashboard.admins.index');
    });

    // لوحة تحكم الأدمن
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admins.index');
    })->middleware(['auth', 'verified'])->name('admin.index');

    // بداية cities
    Route::resource('/cities', CityController::class);
    Route::post('/check-city-name', [CityController::class, 'checkCityName'])->name('cities.checkName');



    // بداية holidays
    Route::resource('/holidays', HolidayController::class);
    Route::post('/check-holiday-name', [HolidayController::class, 'checkHolidayName'])->name('holidays.checkName');

});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/{page}', [PageController::class, 'index']);
