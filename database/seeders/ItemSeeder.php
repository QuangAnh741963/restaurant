<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Bún chả',
                'price' => 40000,
                'unit' => 'bát'
            ],
            [
                'name' => 'Bún bò Huế',
                'price' => 40000,
                'unit' => 'bát'
            ],
            [
                'name' => 'Bún đậu mắm tôm',
                'price' => 40000,
                'unit' => 'bát'
            ],
            [
                'name' => 'Rau muống xào tỏi',
                'price' => 50000,
                'unit' => 'đĩa'
            ],
            [
                'name' => 'Thịt kho tàu',
                'price' => 35000,
                'unit' => 'bát'
            ],
            [
                'name' => 'Thịt quay',
                'price' => 35000,
                'unit' => 'đĩa'
            ],
            [
                'name' => 'Bò sốt vang',
                'price' => 35000,
                'unit' => 'đĩa'
            ],
            [
                'name' => 'Tôm rang nước mắm',
                'price' => 30000,
                'unit' => 'đĩa'
            ],
            [
                'name' => 'Nem chua',
                'price' => 5000,
                'unit' => 'cái'
            ],
            [
                'name' => 'Cháo lòng',
                'price' => 25000,
                'unit' => 'bát'
            ]
        ];

        foreach ($items as $item) {
            Item::create([
                'name' => $item['name'],
                'price' => $item['price'],
                'unit' => $item['unit']
            ]);
        }
    }
}
