<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $firstName = $this->faker->firstName($gender);
        $lastName = $this->faker->lastName($gender);
        $fullName = $firstName.' '.$lastName;
        $slug = Str::slug($fullName);
        $email = $slug.'@gmail.com';
        $positionId = Position::get()->random()->id;
        $headId = (count(User::withRole('employee')) > 0) ? User::withRole('employee')->random()->id : null;
        $adminId = User::withRole('admin')->random()->id;
        $employeeRoleId = Role::roleIdFor('employee')->id;
        return [
            'name' => $fullName,
            'position_id' => $positionId,
            'date_of_employment' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'phone' => $this->faker->numerify('+380#########'),
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'salary' => $this->faker->randomFloat(3, 0, 500),
            'head_id' => $headId,
            'admin_created_id' => $adminId,
            'admin_updated_id' => $adminId,
            'role_id' => $employeeRoleId,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
