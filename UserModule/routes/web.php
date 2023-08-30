<?php

use App\Http\Controllers\dashboard\AddressController;
use Illuminate\Support\Facades\Route;
use UserModule\app\Http\Controllers\SocialiteController;
use UserModule\app\Http\Controllers\UserController;

Route::group([
    'prefix' => 'user',
    'middleware' => ['admin', 'active'],
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

    Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])
        ->name('auth.redirect');
    Route::get('/auth/callback', [SocialiteController::class, 'callback']);

});
