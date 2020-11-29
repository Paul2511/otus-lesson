<?php


namespace App\Services\Routes\Provider;


use App\Http\Controllers\Admin\Survey\AdminSurveysController;
use Route;


class AdminSurveysRoutes
{

    const SURVEYS_INDEX   = 'admin.surveys.index';
    const SURVEYS_SHOW    = 'admin.surveys.show';
    const SURVEYS_EDIT    = 'admin.surveys.edit';
    const SURVEYS_CREATE  = 'admin.surveys.create';
    const SURVEYS_STORE   = 'admin.surveys.store';
    const SURVEYS_UPDATE  = 'admin.surveys.update';
    const SURVEYS_DESTROY = 'admin.surveys.destroy';

    const QUESTIONS_INDEX   = 'admin.questions.index';
    const QUESTIONS_SHOW    = 'admin.questions.show';
    const QUESTIONS_EDIT    = 'admin.questions.edit';
    const QUESTIONS_CREATE  = 'admin.questions.create';
    const QUESTIONS_STORE   = 'admin.questions.store';
    const QUESTIONS_UPDATE  = 'admin.questions.update';
    const QUESTIONS_DESTROY = 'admin.questions.destroy';

}