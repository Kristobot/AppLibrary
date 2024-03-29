<?php

namespace App\Policies;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Notifications\Action;

class LoanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return in_array($user->role_id, [User::IS_ADMIN, User::IS_LIBRARIAN]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Loan $loan): bool
    {
        //
        return in_array($user->role_id, [User::IS_ADMIN, User::IS_LIBRARIAN]) || $user->id === $loan->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return in_array($user->role_id, [User::IS_ADMIN, User::IS_LIBRARIAN, User::IS_USER]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Loan $loan): bool
    {
        //
        return $user->id === $loan->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Loan $loan): bool
    {
        //
        return in_array($user->id, [User::IS_ADMIN, User::IS_LIBRARIAN]) || $user->id === $loan->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Loan $loan): bool
    {
        //
        return $user->id === $loan->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Loan $loan): bool
    {
        //
        return $user->id === $loan->user_id;
    }
}
