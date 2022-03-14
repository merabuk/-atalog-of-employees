<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            'Backend developer',
            'Frontend developer',
            'Lead designer',
            'Contextual advertising specialist',
            'Leading specialist of COntrol Department'
        ];
        foreach ($positions as $name) {
            $adminId = User::withRole('admin')->random()->id;
            $position = new Position();
            $position->name = $name;
            $position->admin_created_id = $adminId;
            $position->admin_updated_id = $adminId;
            $position->save();
        }
    }
}
