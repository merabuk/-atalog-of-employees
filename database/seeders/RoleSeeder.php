<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = Str::slug($admin->name);
        $admin->save();

        $employee = new Role();
        $employee->name = 'Employee';
        $employee->slug = Str::slug($employee->name);
        $employee->save();
    }
}
