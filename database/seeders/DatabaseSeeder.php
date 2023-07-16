<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(10)->create();
        Restaurant::factory(1)->create();
        Customer::factory(100)->create();

        $this->call([
            OrderStateSeeder::class,
            ItemSeeder::class,
            ExtraItemsSeeder::class,
            TableSeeder::class
        ]);
    }
}
