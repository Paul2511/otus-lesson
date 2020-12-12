<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Auth\Access\AuthorizationException;

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
        //
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'message' => trans('form.validationErrorMessage'),
                'errors' => $e->errors(),
                'success' => false
            ], 422);
        }

        if ($e instanceof AccessDeniedHttpException) {
            return response()->json([
                'message' => trans('auth.accessDenied'),
                'success' => false
            ], 403);
        }

        if ($e instanceof AuthorizationException) {
            return response()->json([
                'message' => trans('auth.wrongAuth'),
                'errors' => [
                    'password'=>[trans('auth.wrongAuth')]
                ],
                'success' => false
            ], 401);
        }

        return parent::render($request, $e);
    }
}
