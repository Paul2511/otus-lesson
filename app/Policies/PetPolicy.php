<?php

namespace App\Policies;

use App\Models\Pet;
use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class PetPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin || $user->isManager) {
            return true;
        }
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        $authUser = Auth::user();
        $userId = $authUser->getAuthIdentifier();
        return $userId == $user->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return mixed
     */
    public function view(User $user, Pet $pet)
    {
        return $pet->client_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == User::ROLE_CLIENT;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return mixed
     */
    public function update(User $user, Pet $pet)
    {
        return $pet->client_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Pet  $pet
     * @return mixed
     */
    public function delete(User $user, Pet $pet)
    {
        return $pet->client_id == $user->id;
    }
}
