<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\AnimalNotFoundException;
use Illuminate\Validation\ValidationException;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // If the request expects JSON, return a JSON response
        if ($request->expectsJson()) {
            // If the exception is a custom exception, return a custom response
            if ($exception instanceof AnimalNotFoundException) {
                return response()->json([
                    'error' => 'Animal not found',
                    'animal_id' => $exception->getAnimalId(),
                ], 404);
            }

            // Add more conditions for handling other custom exceptions if necessary

            // Handle other exceptions or fall back to a generic response
            return response()->json(['error' => 'Something went wrong'], 500);
        }

        // Handle non-JSON requests or return a view for web requests
        return parent::render($request, $exception);

    }


}
