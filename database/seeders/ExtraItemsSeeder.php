<?php

namespace Database\Seeders;

use App\Models\ExtraItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extraItems = [
            [
                'name' => 'Rượu trắng',
                'price' => 20000,
                'unit' => 'chai'
            ],
            [
                'name' => 'Khăn giấy',
                'price' => 5000,
                'unit' => 'gói'
            ],
            [
                'name' => 'Nước đóng chai',
                'price' => 10000,
                'unit' => 'chai'
            ],
            [
                'name' => 'Bia',
                'price' => 10000,
                'unit' => 'lon'
            ],
            [
                'name' => 'Cà phê',
                'price' => 15000,
                'unit' => 'cốc'
            ],
            [
                'name' => 'Nước ngọt',
                'price' => 10000,
                'unit' => 'cốc'
            ],
            [
                'name' => 'Dưa hấu',
                'price' => 20000,
                'unit' => 'đĩa'
            ],
            [
                'name' => 'Quýt',
                'price' => 20000,
                'unit' => 'chai'
            ],
            [
                'name' => 'Kem',
                'price' => 10000,
                'unit' => 'que'
            ]
        ];

        foreach ($extraItems as $extraItem) {
            ExtraItem::create([
                'name' => $extraItem['name'],
                'price' => $extraItem['price'],
                'unit' => $extraItem['unit']
            ]);
        }
    }
}
