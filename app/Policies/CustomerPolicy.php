<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Customer $customer)
    {
        return $user->isAdmin() || $customer->created_by == $user->id || $customer->assigned_to == $user->id;
    }

    public function update(User $user, Customer $customer)
    {
        return $user->isAdmin() || $customer->assigned_to == $user->id;
    }

    public function delete(User $user, Customer $customer)
    {
        return $user->isAdmin();
    }

    public function assign(User $user, Customer $customer)
    {
        return $user->isAdmin();
    }

    public function createAction(User $user, Customer $customer)
    {
        return $user->isAdmin() || $customer->assigned_to == $user->id;
    }
}
