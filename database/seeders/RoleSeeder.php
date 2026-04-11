<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Ensure at least one role exists for registration (config payroll.default_role_id).
     *
     * @return void
     */
    public function run()
    {
        $exists = DB::table('roles')->where('role_id', config('payroll.default_role_id'))->exists();

        if ($exists) {
            return;
        }

        DB::table('roles')->insert([
            'role_id' => config('payroll.default_role_id'),
            'role_name' => 'Employee',
            'description' => 'Default self-service employee role',
            'permission_id' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
