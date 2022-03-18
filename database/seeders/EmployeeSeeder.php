<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create()->each(function ($employee) {
            $headId = User::withRole('employee')
                ->where('position_id', '>=', $employee->position_id)
                ->whereNotIn('id', $employee->id)->random()->id;
            $employee->head_id = $headId;
            $employee->save();
        });
    }
}
