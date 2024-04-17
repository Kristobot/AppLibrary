<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->can('authors.index');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Author $author)
    {
        //
        return $user->can('authors.show');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->can('authors.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Author $author): bool
    {
        //
        return $user->can('authors.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Author $author): bool
    {
        //
        return $user->can('authors.delete');
    }
}
