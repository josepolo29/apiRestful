<?php

namespace App\Policies;

use App\Models\Buyer;
use App\Models\User;
use App\Traits\AdminActions;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyerPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Buyer  $buyer
     * @return mixed
     */
    public function view(User $user, Buyer $buyer)
    {
        return $user->id === $buyer->id;
    }

    /**
     * Determine whether the user can purchase something.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Buyer  $buyer
     * @return mixed
     */
    // public function purchase(User $user, Buyer $buyer)
    // {
    //     return $user->id === $buyer->id;
    // }

}
