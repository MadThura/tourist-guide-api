<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    public function changeRole(User $authUser, User $targetUser): bool
    {
        // 1. Can't modify own role
        if ($authUser->id === $targetUser->id) {
            return false;
        }

        // 2. Prevent non-superadmin from changing any admin's role
        if ($targetUser->role === 'admin' && $authUser->role !== 'superadmin') {
            return false;
        }

        // 3. Prevent promoting to admin unless superadmin
        if (request('role') === 'admin' && $authUser->role !== 'superadmin') {
            return false;
        }

        // 4. Prevent changing superadmin's role at all
        if ($targetUser->role === 'superadmin') {
            return false;
        }

        // 5. Optional: prevent superadmin from demoting themselves (for safety)
        if ($authUser->id === $targetUser->id && $authUser->role === 'superadmin') {
            return false;
        }

        return true;
    }


    public function toggleStatus(User $authUser, User $targetUser): bool
    {
        // 1. Can't act on self
        if ($authUser->id === $targetUser->id) {
            return false;
        }

        // 2. Only superadmin can touch admins
        if ($targetUser->role === 'admin' && $authUser->role !== 'superadmin') {
            return false;
        }

        // 3. Superadmin is protected
        if ($targetUser->role === 'superadmin') {
            return false;
        }

        // 4. Superadmin cannot demote themselves
        if ($authUser->id === $targetUser->id && $authUser->role === 'superadmin') {
            return false;
        }

        return true;
    }
}
