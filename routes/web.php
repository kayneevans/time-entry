<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();
Auth::routes(['register' => false]);


Route::resource('seasons', 'SeasonsController');
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::get('/time', [App\Http\Controllers\TimeController::class, 'index'])->name('time');

Route::get('/time/timekeeper', [App\Http\Controllers\TimeController::class, 'indexTK'])->name('time');

Route::post('/time', [App\Http\Controllers\TimeController::class, 'store'])->name('time');

Route::post('/time/timekeeper', [App\Http\Controllers\TimeController::class, 'storeTK'])->name('time');

Route::get('/time/timekeeper/{time_id}', [App\Http\Controllers\TimeController::class, 'edittk'])->name('time');

Route::post('/time/timekeeper/{time_id}', [App\Http\Controllers\TimeController::class, 'update'])->name('time');

Route::get('/search', [App\Http\Controllers\TimeController::class, 'searchtk'])->name('admin-dashboard');

Route::get('/search-paycode', [App\Http\Controllers\PayCodeController::class, 'searchtk'])->name('admin-dashboard-paycode');

Route::get('/paycode', [App\Http\Controllers\PayCodeController::class, 'index'])->name('paycode');

Route::post('/paycode', [App\Http\Controllers\PayCodeController::class, 'store'])->name('paycode');

Route::get('/paycode/{paycode_entry_id}', [App\Http\Controllers\PayCodeController::class, 'edit'])->name('paycode');

Route::post('/paycode/{paycode_entry_id}', [App\Http\Controllers\PayCodeController::class, 'update'])->name('paycode');