<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'START',
            'SUCCESS',
            'PAYMENT',
            'DONE'
        ];

        foreach ($states as $state) {
            OrderState::create([
                'state' => $state
            ]);
        }
    }
}
