<?php

namespace App\Policies;

use App\Models\Copy;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CopyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->can('copies.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Copy $copy): bool
    {
        //
        return $user->can('copies.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->can('copies.create');
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Copy $copy): bool
    {
        //
        return $user->can('copies.delete');
    }
}
