<?php

namespace App\Services\Weather\DTO;

class WeatherDTO
{
    public string $cityName;
    public string $temp;
    public string $description;

    public function __construct(
        string $cityName,
        string $temp,
        string $description
    ) {
        $this->cityName = $cityName;
        $this->temp = $temp;
        $this->description = $description;
    }

    public static function initFromGismeteoResponse(array $data): WeatherDTO
    {
        return new static(
            $data["data"]["city_name"],
            $data["data"]["cur_w"]["temp"],
            $data["data"]["cur_w"]["description"],
        );
    }
}
