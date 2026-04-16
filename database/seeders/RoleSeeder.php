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
        $exists = DB::table('departments')->where('id', config('payroll.default_role_id'))->exists();

        if ($exists) {
            return;
        }

        DB::table('departments')->insert([
            'id' => config('payroll.default_role_id'),
            'name' => 'Employee',
            'head_employee_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
