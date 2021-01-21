<?php

namespace App\Providers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Role;
use App\Models\Translation;
use App\Models\User;
use App\Policies\AnswerPolicy;
use App\Policies\QuestionCategoryPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TranslationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Question::class => QuestionPolicy::class,
        Answer::class => AnswerPolicy::class,
        QuestionCategory::class => QuestionCategoryPolicy::class,
        Role::class => RolePolicy::class,
        Translation::class => TranslationPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
            if ( $ability === 'admin' && $user->isAdmin() ) {
                return true;
            } elseif ($ability === 'admin' && !$user->isAdmin()) {
                return false;
            }
        });
    }
}
