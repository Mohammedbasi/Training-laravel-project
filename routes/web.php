<?php

use App\Http\Controllers\UserController;
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

Route::get('users',[UserController::class,'index'])->name('index');
Route::get('users/create',[UserController::class,'create'])->name('create');
Route::post('users/store',[UserController::class,'store'])->name('store');
Route::get('users/edit/{user}',[UserController::class,'edit'])->name('edit');
Route::put('users/update{user}',[UserController::class,'update'])->name('update');
Route::delete('users/delete{user}',[UserController::class,'delete'])->name('delete');

Route::get('users/trash',[UserController::class,'trash'])->name('trash');
Route::put('users/restore/{user}',[UserController::class,'restore'])->name('restore');
Route::delete('users/force-delete/{user}',[UserController::class,'forceDelete'])->name('force-delete');

