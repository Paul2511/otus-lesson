<?php

namespace App\Services\Weather;

use App\Services\Weather\DTO\WeatherDTO;

class WeatherService
{

    public function loadWeather(): ?WeatherDTO
    {
        if ($weatherServiceUrl = env('WEATHER_SERVICE_URL')) {
            return WeatherDTO::initFromGismeteoResponse(
                json_decode(file_get_contents($weatherServiceUrl), true) ?? []
            );
        }

        return null;
    }

}
