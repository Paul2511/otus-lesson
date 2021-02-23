<?php

namespace App\Http\Controllers;

use App\Services\Weather\WeatherService;
use Illuminate\Http\Request;
use View;

class PublicPagesController extends Controller
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        // $this->middleware('auth');
        $this->weatherService = $weatherService;
    }

    public function index()
    {
        View::share(
            [
                'weather' => $this->weatherService->loadWeather()
            ]
        );

        return view('pages.welcome');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }


}
