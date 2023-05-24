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
Route::post('/delete-program', [ProgramController::class, 'deleteProgram'])->name('delete-program');
Route::get('/edit-program', [ProgramController::class, 'editProgram'])->name('edit-program');
Route::post('/update-program', [ProgramController::class, 'updateProgram'])->name('update-program');
Route::get('/single-edit-program/{id}', [ProgramController::class, 'singleEditProgram'])->name('single-edit-program');
Route::post('/single-update-program/{id}', [ProgramController::class, 'singleUpdateProgram'])->name('single-update-program');
