<?php

namespace App\Exceptions;

use App\Http\RouteNames;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            $routeName = $request->route()->getName();

            if ($routeName && array_key_exists($routeName, RouteNames::$notFound)) {
                $who = RouteNames::$notFound[$routeName];
                $message = trans($who.'.notFound');
            } else {
                $message = $e->getMessage();
            }

            return response()->json([
                'message' => $message,
                'success' => false
            ], 404);
        });
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

        if ($e instanceof AuthorizationException) {
            return response()->json([
                'message' => trans('auth.accessDenied'),
                'success' => false
            ], 403);
        }

        if ($e instanceof UnauthorizedException) {
            return response()->json([
                'message' => trans('auth.wrongAuth'),
                'errors' => [
                    'password'=>[trans('auth.wrongAuth')]
                ],
                'success' => false
            ], 403);
        }

        if ($e instanceof UnauthorizedHttpException) {
            return response()->json([
                'message' => trans('auth.wrongToken'),
                'success' => false
            ], 401);
        }

        return parent::render($request, $e);
    }
}
