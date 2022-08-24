<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SellerFactory extends Factory
{

    public function definition()
    {
        return [
            'identifier' => $this->faker->randomElement([154521564,5456415,545456]),
            'name' =>  $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->randomElement([525414,4125455]),
            'address' => $this->faker->address(),
        ];
    }
}
