<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;



Route::any('{any}', function(){
    throw new BadRequestException(trans('exception.badRequest'), 400);
})->where('any', '.*');


