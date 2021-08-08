<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });

        $this->renderable(function (Throwable $throwable, Request $request) {
            $statusCode = 500;
            switch ($throwable::class) {
                case ValidationException::class:
                    $statusCode = 400;
                    $error = [
                        'message' => 'Invalid parameters supplied.',
                        'code' => $statusCode,
                        'data' => $throwable->errors()
                    ];
                    break;
                default:
                    $error = [
                        'status' => 'error',
                        'message' => $throwable->getMessage(),
                        'code' => $statusCode,
                    ];
            }

            $error['exception_message'] = $throwable->getMessage();
            $error['trace'] = $throwable->getTraceAsString();

            return response()->json($error)->setStatusCode($statusCode);
        });
    }
}
