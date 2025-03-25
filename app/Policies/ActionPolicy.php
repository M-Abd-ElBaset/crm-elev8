<?php

namespace App\Policies;

use App\Models\Action;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActionPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Action $action)
    {
        return $user->isAdmin() || 
               $action->user_id == $user->id || 
               $action->customer->assigned_to == $user->id;
    }

    public function update(User $user, Action $action)
    {
        return $user->isAdmin() || $action->user_id == $user->id;
    }

    public function delete(User $user, Action $action)
    {
        return $user->isAdmin() || $action->user_id == $user->id;
    }
}
