<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'num_ticket' =>  $this->faker->randomNumber(5),
            'date_register' =>  $this->faker->date(),
            'price' =>  $this->faker->randomNumber(4),
            'remaining_amount' =>  $this->faker->randomNumber(3),
            'id_seller' =>  Seller::factory()->create(),
            'id_client' =>  Client::factory()->create(),
        ];
    }
}
