<?php

namespace App\Policies;

use App\Models\Knowledge;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KnowledgePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role == 'developer' || $user->role == 'admin';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Knowledge  $knowledge
     * @return mixed
     */
    public function view(User $user, Knowledge $knowledge)
    {
        return $user->role == 'developer' || $user->role == 'admin';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'developer' || $user->role == 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Knowledge  $knowledge
     * @return mixed
     */
    public function update(User $user, Knowledge $knowledge)
    {
        return $user->id == $knowledge->user_id || $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Knowledge  $knowledge
     * @return mixed
     */
    public function delete(User $user, Knowledge $knowledge)
    {
        return $user->id == $knowledge->user_id || $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Knowledge  $knowledge
     * @return mixed
     */
    public function restore(User $user, Knowledge $knowledge)
    {
        return $user->id == $knowledge->user_id || $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Knowledge  $knowledge
     * @return mixed
     */
    public function forceDelete(User $user, Knowledge $knowledge)
    {
        return $user->id == $knowledge->user_id || $user->role == 'admin';
    }
}
