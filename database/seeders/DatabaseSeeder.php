<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
//         \App\Models\User::factory(10)->create();

         \App\Models\Client::factory(10)->create();
         \App\Models\Seller::factory(10)->create();
         \App\Models\Ticket::factory(10)->create();
         \App\Models\Payment::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
