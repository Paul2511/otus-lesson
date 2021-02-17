<?php

namespace App\Services\Routes\Providers\Api;

use App\Models\Question;
use App\Models\Survey;


class ApiRoutes
{

    public const SURVEYS_INDEX   = 'api.surveys.index';
    public const SURVEYS_LIST   = 'api.surveys.list';
    public const SURVEYS_SHOW    = 'api.surveys.show';
    public const SURVEYS_STORE   = 'api.surveys.store';
    public const SURVEYS_UPDATE  = 'api.surveys.update';
    public const SURVEYS_DESTROY = 'api.surveys.destroy';

    public static function surveysIndex(): string
    {
        return route(static::SURVEYS_INDEX);
    }

    public static function surveysList(?int $limit = null, ?int $offset = null): string
    {
        return route(
            static::SURVEYS_LIST,
            array_filter(compact('limit', 'offset'))
        );
    }

    public static function surveysShow(Survey $survey): string
    {
        return route(static::SURVEYS_SHOW, $survey);
    }

    public static function surveysStore(): string
    {
        return route(static::SURVEYS_STORE);
    }

    public static function surveysUpdate(Survey $survey): string
    {
        return route(static::SURVEYS_UPDATE, $survey);
    }

    public static function surveysDestroy(Survey $survey): string
    {
        return route(static::SURVEYS_DESTROY, $survey);
    }

}
