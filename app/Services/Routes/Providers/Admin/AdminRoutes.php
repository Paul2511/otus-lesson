<?php


namespace App\Services\Routes\Providers\Admin;


use App\Models\Question;
use App\Models\Survey;


class AdminRoutes
{
    public const SURVEYS_INDEX = 'admin.surveys.index';
    public const SURVEYS_SHOW = 'admin.surveys.show';
    public const SURVEYS_EDIT = 'admin.surveys.edit';
    public const SURVEYS_CREATE = 'admin.surveys.create';
    public const SURVEYS_STORE = 'admin.surveys.store';
    public const SURVEYS_UPDATE = 'admin.surveys.update';
    public const SURVEYS_DESTROY = 'admin.surveys.destroy';

    public const QUESTIONS_INDEX = 'admin.questions.index';
    public const QUESTIONS_SHOW = 'admin.questions.show';
    public const QUESTIONS_EDIT = 'admin.questions.edit';
    public const QUESTIONS_CREATE = 'admin.questions.create';
    public const QUESTIONS_STORE = 'admin.questions.store';
    public const QUESTIONS_UPDATE = 'admin.questions.update';
    public const QUESTIONS_DESTROY = 'admin.questions.destroy';

    public static function surveysIndex(): string
    {
        return route(static::SURVEYS_INDEX);
    }

    public static function surveysShow(Survey $survey): string
    {
        return route(static::SURVEYS_SHOW, $survey);
    }

    public static function surveysEdit(Survey $survey): string
    {
        return route(static::SURVEYS_EDIT, $survey);
    }

    public static function surveysCreate(): string
    {
        return route(static::SURVEYS_CREATE);
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


    public static function questionsIndex(Survey $survey): string
    {
        return route(static::QUESTIONS_INDEX, $survey);
    }

    public static function questionsShow(Survey $survey, Question $question): string
    {
        return route(static::QUESTIONS_SHOW, [$survey, $question]);
    }

    public static function questionsEdit(Survey $survey, Question $question): string
    {
        return route(static::QUESTIONS_EDIT, [$survey, $question]);
    }

    public static function questionsCreate(Survey $survey): string
    {
        return route(static::QUESTIONS_CREATE, $survey);
    }

    public static function questionsStore(Survey $survey): string
    {
        return route(static::QUESTIONS_STORE, $survey);
    }

    public static function questionsUpdate(Survey $survey, Question $question): string
    {
        return route(static::QUESTIONS_UPDATE, [$survey, $question]);
    }

    public static function questionsDestroy(Survey $survey, Question $question): string
    {
        return route(static::QUESTIONS_DESTROY, [$survey, $question]);
    }

}
