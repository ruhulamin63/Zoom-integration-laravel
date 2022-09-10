<?php

use App\Http\Controllers\Zoom\ZoomController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [ZoomController::class, 'index'])->name('zoom.index');
Route::get('/create-zoom', [ZoomController::class, 'create'])->name('zoom.create');
Route::post('/store-zoom', [ZoomController::class, 'store'])->name('zoom.store');
Route::delete('/delete-zoom', [ZoomController::class, 'destroy'])->name('zoom.delete');
