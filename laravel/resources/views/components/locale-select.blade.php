<?php
    /** @var array $routes */
?>
@foreach($routes as $locale => $route)
    <a href="{{ $route }}">{{ $locale }}</a>
@endforeach
