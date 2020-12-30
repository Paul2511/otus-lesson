<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    //Общая вспомогательная функция для отладки
    protected function ddResponse(TestResponse $response)
    {
        $content = $response->getContent();
        dd(json_decode($content, true));
    }
}
