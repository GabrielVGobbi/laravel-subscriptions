<?php

namespace App\Observers;

use App\Models\ACL\Role;

class RoleObserver
{
    /**
     * Handle the plan "creating" event.
     *
     * @param  \App\Models\ACL\Role $role
     * @return void
     */
    public function creating(Role $role)
    {
    }

    /**
     * Handle the plan "updating" event.
     *
     * @param \App\Models\ACL\Role $role
     * @return void
     */
    public function updating(Role $role)
    {
    }
}
