<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use App\Traits\AdminActions;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization, AdminActions;

    /**
     * Determine whether the user can add a category form a product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return mixed
     */
    public function addCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }

    /**
     * Determine whether the user can remove a category form a product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return mixed
     */
    public function deleteCategory(User $user, Product $product)
    {
        return $user->id === $product->seller->id;
    }
}
