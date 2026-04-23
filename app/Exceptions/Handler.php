<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Handle JSON requests normally
        if ($request->expectsJson()) {
            return parent::render($request, $exception);
        }

        // Handle validation exceptions
        if ($exception instanceof ValidationException) {
            return parent::render($request, $exception);
        }

        // Handle authentication exceptions
        if ($exception instanceof AuthenticationException) {
            return redirect()->route('login')->withErrors(['error' => 'Vui lòng đăng nhập.']);
        }

        // Handle HTTP exceptions
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Handle other HTTP exceptions
        if ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            if ($statusCode >= 500) {
                return response()->view('errors.500', [], $statusCode);
            }
        }

        // For other exceptions, show generic error page or redirect
        return response()->view('errors.500', [], 500);
    }
}
