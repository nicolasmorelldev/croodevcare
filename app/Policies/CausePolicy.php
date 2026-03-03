<?php

namespace App\Policies;

use App\Models\Cause;
use App\Models\User;

class CausePolicy
{
    public function before(User $user, string $ability): ?bool
    {
        return $user->isSuperAdmin() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Cause $cause): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Cause $cause): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Cause $cause): bool
    {
        return $user->isAdmin();
    }
}
