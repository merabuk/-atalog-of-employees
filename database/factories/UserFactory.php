<?php

namespace Database\Factories;

use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ImageModel;
use Image;

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
        $fullName = $this->faker->name($gender);
        $slug = Str::slug($fullName);
        $positionId = Position::get()->random()->id;
        $adminId = User::getUsersByRoleSlug('admin')->random()->id;
        $employeeRoleId = Role::getRoleBySlug('employee')->id;
        $rndstr = Str::random(5);
        $email = $slug.$rndstr.'@gmail.com';
        return [
            'name' => $fullName,
            'position_id' => $positionId,
            'date_of_employment' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'phone' => $this->faker->numerify('+380#########'),//e164PhoneNumber()
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'salary' => $this->faker->randomFloat(3, 0, 500),
            'admin_created_id' => $adminId,
            'admin_updated_id' => $adminId,
            'role_id' => $employeeRoleId,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user){
            $number = $this->faker->numberBetween(1, 6);
            $imageName = Str::random(40);
            $imagePath = 'images/'.$imageName.'.jpg';
            $fullPath = public_path('storage/'.$imagePath);
            Image::make(public_path('images/avatar'.$number.'.jpg'))
                    ->fit(300)
                    ->save($fullPath, 80);
            $image = new ImageModel();
            $image->path = $imagePath;
            $image->user_id = $user->id;
            $image->save();
        });
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
