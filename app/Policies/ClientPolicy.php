<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
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
        return $user->role == User::MANAGER || $user->role == User::ADMIN;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return mixed
     */
    public function view(User $user, Client $client)
    {
        return $user->role == User::MANAGER || $user->role == User::ADMIN;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == User::MANAGER || $user->role == User::ADMIN;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return mixed
     */
    public function update(User $user, Client $client)
    {
        return $user->id == $client->user_id || $user->role == User::ADMIN;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return mixed
     */
    public function delete(User $user, Client $client)
    {
        return $user->id == $client->user_id || $user->role == User::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return mixed
     */
    public function restore(User $user, Client $client)
    {
        return $user->id == $client->user_id || $user->role == User::ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Client  $client
     * @return mixed
     */
    public function forceDelete(User $user, Client $client)
    {
        return $user->id == $client->user_id || $user->role == User::ADMIN;
    }
}
