<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, \Exception|Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof AuthorizationException) {
                return response()->json(['error' => 'Unauthorized Ability'], 403);
            }
        }
        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'unauthorized'
                ], 401);
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'error in Validation'
                ], 401);
            }
        });

        $this->reportable(function (QueryException $e) {
            if ($e->getCode() === '23000') {
                Log::warning($e->getMessage());
                return false;
            }
            return true;
        });
        $this->renderable(function (QueryException $e, Request $request) {
            if ($e->getCode() == 23000) {
                $message = 'Foreign key constraint failed';
            } else {
                $message = $e->getMessage();
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                ], 400);
            }
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'message' => $e->getMessage()
                ])
                ->with('info', $message);
        });
    }
}
