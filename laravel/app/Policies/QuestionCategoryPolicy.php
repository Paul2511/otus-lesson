<?php

namespace App\Policies;

use App\Models\QuestionCategory;
use App\Models\User;


class QuestionCategoryPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return mixed
     */
    public function view(User $user, QuestionCategory $questionCategory)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return mixed
     */
    public function update(User $user, QuestionCategory $questionCategory)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return mixed
     */
    public function delete(User $user, QuestionCategory $questionCategory)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return mixed
     */
    public function restore(User $user, QuestionCategory $questionCategory)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\QuestionCategory  $questionCategory
     * @return mixed
     */
    public function forceDelete(User $user, QuestionCategory $questionCategory)
    {
        //
    }
}
