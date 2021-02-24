@if ($weather ?? false)
    <div class="weather">
        <div class="weather__city">{{ $weather->cityName }}</div>
        <div>
            <span class="weather__temp">{{ $weather->temp }} <sup>o</sup>C</span>
            <span class="weather__description">{{ $weather->description }}</span>
        </div>
    </div>
@endif
