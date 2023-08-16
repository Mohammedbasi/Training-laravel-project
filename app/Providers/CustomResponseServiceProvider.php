<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class CustomResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($data = [], $message = 'Success', $status = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data,
            ], $status);
        });

        Response::macro('error', function ($data = [], $message = 'Error', $status = 400) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], $status);
        });
    }
}
