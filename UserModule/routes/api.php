<?php


use App\Enums\TokenAbility;
use App\Models\Item;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use UserModule\App\Http\Controllers\Api\AuthController;
use UserModule\App\Http\Controllers\Api\UserController;

Route::group([
    'middleware' => 'guest:sanctum'
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);
});

Route::group([
    'middleware' => ['auth:sanctum', 'admin', 'ability:' . TokenAbility::ACCESS_API->value],
], function () {
    Route::get('/items', function () {
        return Item::all();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/users', UserController::class);

});


Route::post('/refresh-token', [AuthController::class, 'refresh'])
    ->middleware(['ability:' . TokenAbility::ISSUE_ACCESS_TOKEN->value, 'auth:sanctum']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
