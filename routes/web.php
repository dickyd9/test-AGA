<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CutiPegawai;
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

// Route::get('/pegawai', function () {
//     return view('index');
// });
// Route::get('/pegawai', [PegawaiController::class, 'index']);
// Route::resource('/', PegawaiController::class);
// Route::delete('/{id}', 'PegawaiController@destroy')->name('index.destroy');

Route::get('/', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::delete('/{pegawai}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::resource('/cuti', CutiPegawai::class);
