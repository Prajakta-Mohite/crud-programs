<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramController;
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
//     return view('welcome');
// });

Route::get('/', [ProgramController::class, 'index'])->name('home');
Route::get('/show-program', [ProgramController::class, 'showProgram'])->name('show-program');
Route::get('/add-program', [ProgramController::class, 'addProgram'])->name('add-program');
Route::post('/store-program', [ProgramController::class, 'storeProgram'])->name('store-program');
