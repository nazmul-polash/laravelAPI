<?php

use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CountryCountroller;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');

Route::get('personal/info',[PersonalInfoController::class, 'create'])->name('presonal.info.create');
Route::post('personal/info/store',[PersonalInfoController::class, 'store'])->name('pesonal.info.store');

Route::get('/search',[PersonalInfoController::class, 'designation_search'])->name('search.autocomplete');


Route::post('/country/store', [CountryCountroller::class, 'store'])->name('country.store');
Route::post('/city/store', [CountryCountroller::class, 'city_store'])->name('enable.city');
Route::post('/area/get', [CountryCountroller::class, 'get_area'])->name('enable.area');
