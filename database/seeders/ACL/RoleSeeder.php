<?php

namespace Database\Seeders\ACL;

use App\Models\ACL\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dev_role = Role::firstOrCreate([
            'name' => 'Developer',
        ], [
                'slug' => 'developer',
            ]);
    }
}
