<?php

use App\Http\Controllers\Dashboard\AddressController;
use App\Http\Controllers\dashboard\BrandController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ItemController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\VendorsController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => 'user',
    'middleware' => 'admin',
], function () {
    Route::get('/address/{user}', [AddressController::class, 'edit'])
        ->name('user.address.edit');
    Route::put('/address/{user}', [AddressController::class, 'update'])
        ->name('user.address.update');
    Route::get('all', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/delete{user}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('/trash', [UserController::class, 'trash'])->name('user.trash');
    Route::put('/restore/{user}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('/force-delete/{user}', [UserController::class, 'forceDelete'])->name('user.force-delete');
});

Route::group([
    'middleware' => 'admin',
], function () {
    Route::get('vendors/address/{vendor}', [AddressController::class, 'edit'])
        ->name('vendors.address.edit');
    Route::put('vendors/address/{vendor}', [AddressController::class, 'update'])
        ->name('vendors.address.update');
    Route::get('vendors/trash', [VendorsController::class, 'trash'])->name('vendors.trash');
    Route::put('vendors/restore/{user}', [VendorsController::class, 'restore'])->name('vendors.restore');
    Route::delete('vendors/force-delete/{user}', [VendorsController::class, 'forceDelete'])->name('vendors.force-delete');
    Route::resource('/vendors', VendorsController::class);
});

Route::group([
    'middleware' => 'admin'
], function () {
    Route::get('brands/trash', [BrandController::class, 'trash'])->name('brands.trash');
    Route::put('brands/restore/{brand}', [BrandController::class, 'restore'])->name('brands.restore');
    Route::delete('brands/force-delete/{brand}', [BrandController::class, 'forceDelete'])->name('brands.force-delete');
    Route::resource('/brands', BrandController::class);
});

Route::group([
    'middleware' => 'admin'
], function () {
    Route::get('items/trash', [ItemController::class, 'trash'])->name('items.trash');
    Route::put('items/restore/{brand}', [ItemController::class, 'restore'])->name('items.restore');
    Route::delete('items/force-delete/{brand}', [ItemController::class, 'forceDelete'])->name('items.force-delete');
    Route::resource('/items', ItemController::class);
});

require __DIR__ . '/auth.php';
