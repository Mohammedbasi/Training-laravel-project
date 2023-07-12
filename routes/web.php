<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix'=>'user'
],function (){
    Route::get('all',[UserController::class,'index'])->name('user.index');
    Route::get('/create',[UserController::class,'create'])->name('user.create');
    Route::post('/store',[UserController::class,'store'])->name('user.store');
    Route::get('/edit/{user}',[UserController::class,'edit'])->name('user.edit');
    Route::put('/update{user}',[UserController::class,'update'])->name('user.update');
    Route::delete('/delete{user}',[UserController::class,'delete'])->name('user.delete');

    Route::get('/trash',[UserController::class,'trash'])->name('user.trash');
    Route::put('/restore/{user}',[UserController::class,'restore'])->name('user.restore');
    Route::delete('/force-delete/{user}',[UserController::class,'forceDelete'])->name('user.force-delete');
});


require __DIR__.'/auth.php';
