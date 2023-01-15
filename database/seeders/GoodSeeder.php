<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->delete();
        $goods = [
            // Barang Milik Bob
            [
                'owner_id' => 1,
                'category_id' => 3,
                'good_name' => 'Baju Korea',
                'good_description' => "Baju Korea Wanita Ukuran M",
                'price' => 50000,
                'good_picture' => "Baju Korea.jpg",
            ],

            [
                'owner_id' => 1,
                'category_id' => 3,
                'good_name' => 'Hoodie Pink',
                'good_description' => "Hoodie Pink Pria Ukuran L",
                'price' => 200000,
                'good_picture' => "Hoodie Pink.jpg",
            ],

            [
                'owner_id' => 1,
                'category_id' => 3,
                'good_name' => 'Celana Panjang',
                'good_description' => "Celana Panjang Pria Ukuran XL",
                'price' => 100000,
                'good_picture' => "Celana Panjang.jpg",
            ],

            // Barang Milik Dan
            [
                'owner_id' => 2,
                'category_id' => 1,
                'good_name' => 'LG LED TV 32 Inch',
                'good_description' => "Televisi LED LG Ukuran 32 Inch Berwarna Hitam",
                'price' => 2800000,
                'good_picture' => "Televisi.jpg",
            ],

            [
                'owner_id' => 2,
                'category_id' => 1,
                'good_name' => 'HP Xiaomi Poco M3',
                'good_description' => "Handphone Xiaomi Poco M3 dengan chipset Snapdragon 662 dan Baterai 6000 mAH",
                'price' => 1700000,
                'good_picture' => "HP Xiaomi.jpg",
            ],

            [
                'owner_id' => 2,
                'category_id' => 1,
                'good_name' => 'Monitor Viewsonic 24 Inch',
                'good_description' => "Monitor LED Viewsonic dengan ukuran layar 24 Inch",
                'price' => 2000000,
                'good_picture' => "Viewsonic.jpg",
            ],

            // Barang Milik Bill
            [
                'owner_id' => 3,
                'category_id' => 2,
                'good_name' => 'Makaroni Pedas',
                'good_description' => "Makaroni Pedas Ukuran 250 gram",
                'price' => 10000,
                'good_picture' => "Makaroni.jpg",
            ],

            [
                'owner_id' => 3,
                'category_id' => 2,
                'good_name' => 'Doritos rasa Nacho Cheese',
                'good_description' => "Doritos rasa Nacho Cheese dengan ukuran 262.2 gram",
                'price' => 50000,
                'good_picture' => "Doritos.png",
            ],

            [
                'owner_id' => 3,
                'category_id' => 2,
                'good_name' => 'Biskuit Oreo 266 Gram',
                'good_description' => "Biskuit Oreo 266 Gram rasa Original",
                'price' => 15000,
                'good_picture' => "Oreo.jpg",
            ],

            // Barang Milik Rob
            [
                'owner_id' => 4,
                'category_id' => 4,
                'good_name' => 'Jam Tangan Pria G-Shock warna Black Rosegold GA-700MMC-1ADR',
                'good_description' => "Jam Tangan Pria G-Shock warna Black Rosegold GA-700MMC-1ADR diameter 55 mm dan tebal 18 mm",
                'price' => 2100000,
                'good_picture' => "G-Shock.jpg",
            ],

            [
                'owner_id' => 4,
                'category_id' => 4,
                'good_name' => 'Kalung Perak Wanita',
                'good_description' => "Kalung Perak Wanita Layer Crystal Panjang 45 cm",
                'price' => 400000,
                'good_picture' => "Kalung Perak.jpg",
            ],

            [
                'owner_id' => 4,
                'category_id' => 4,
                'good_name' => 'Kacamata Hitam Pria dan Wanita Polaroid',
                'good_description' => "Kacamata Hitam Pria Polaroid Magnesium Sunglasses",
                'price' => 100000,
                'good_picture' => "Kacamata Hitam.jpg",
            ],
        ];

        DB::table('goods')->insert($goods);
    }
}
