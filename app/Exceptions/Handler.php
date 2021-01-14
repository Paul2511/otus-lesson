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

    protected $dontReport = [

    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
//        $this->renderable(function (NotFoundHttpException $e, Request $request) {
//            return response()->view('errors.404', array(), 404);
//        });
//
//
    }

    public function render($request, $exception)
    {
        if ($request->isMethod('get') && $exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', array(), 404);
        }
        return parent::render($request, $exception);
    }

}
