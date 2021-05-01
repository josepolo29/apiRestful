<?php

namespace App\Policies;

use App\Models\User;
use App\Models\transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\transaction  $transaction
     * @return mixed
     */
    public function view(User $user, transaction $transaction)
    {
        return $user->id === $transaction->buyer->id || $user->id === $transaction->product->seller->id;
    }
}
