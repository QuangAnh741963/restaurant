<?php

namespace Database\Seeders;

use App\Models\Table;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tableId = ['A01', 'A02', 'A03', 'A04', 'A05', 'B01', 'B02', 'B03', 'C01', 'C02', 'C03'];

        foreach ($tableId as $id) {
            Table::create([
                'id' => $id,
                'quantity' => fake()->randomElement([4, 6]),
                'available' => true
            ]);
        }
    }
}
