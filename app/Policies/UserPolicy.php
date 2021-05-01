<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\user  $model
     * @return mixed
     */
    public function view(User $authenticatedUser, user $user)
    {
        return $authenticatedUser->id === $user->id;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\user  $model
     * @return mixed
     */
    public function update(User $authenticatedUser, user $user)
    {
        return $authenticatedUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\user  $model
     * @return mixed
     */
    public function delete(User $authenticatedUser, user $user)
    {
        return $authenticatedUser->id === $user->id && $authenticatedUser->token()->client->personal_access_client;
    }
}
