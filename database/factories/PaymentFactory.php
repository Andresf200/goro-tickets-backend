<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition()
    {
        return [
            'date_pay' =>  $this->faker->date(),
            'mount' =>  $this->faker->randomNumber(5),
            'id_ticket' =>  Ticket::factory()->create(),
        ];
    }
}
