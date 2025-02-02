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
    return view('index');
});

use Illuminate\Support\Facades\Artisan;

Route::get('/sync-data', function () {
    Artisan::call('sync:server-data');
    return back()->with('success', 'Data synced successfully!');
})->name('sync-data');