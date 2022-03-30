<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ImageModel;
use Image;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->command->comment('Seeding 100 an employee... Please wait...');
        User::factory()->has(
            User::factory()->count(10)->has(
                User::factory()->count(10)->has(
                    User::factory()->count(10)->has(
                        User::factory()->count(10)
                    , 'children')
                , 'children')
            , 'children')
        , 'children')->create();
    }
}
