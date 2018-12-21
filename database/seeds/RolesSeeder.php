<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

final class RolesSeeder extends Seeder
{
    /**
     * Roles to import.
     *
     * @return  array
     */
    protected function roles()
    {
        return ['admin', 'user'];
    }

    public function run()
    {
        foreach ($this->roles() as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
