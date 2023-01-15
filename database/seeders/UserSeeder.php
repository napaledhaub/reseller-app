<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $users = [
            // Owners
            ['name' => 'Bob',
             'email' => 'bob@gmail.com',
             'password' => Hash::make("password"),
             'role' => 1,
             'address' => "Jakarta",
             'phone' => "08122836283",
             'ktp' => "36740292938270009",
             'description' => "Menjual pakaian",
             'picture' => "npc_wojak.png"],

             ['name' => 'Dan',
             'email' => 'dan@gmail.com',
             'password' => Hash::make("password"),
             'role' => 1,
             'address' => "Tangerang",
             'phone' => "08122836298",
             'ktp' => "36740292938270007",
             'description' => "Menjual barang elektronik",
             'picture' => "npc_wojak.png"],

             ['name' => 'Bill',
             'email' => 'bill@gmail.com',
             'password' => Hash::make("password"),
             'role' => 1,
             'address' => "Bekasi",
             'phone' => "08122399283",
             'ktp' => "36740292938270239",
             'description' => "Menjual makanan ringan",
             'picture' => "npc_wojak.png"],

             ['name' => 'Rob',
             'email' => 'rob@gmail.com',
             'password' => Hash::make("password"),
             'role' => 1,
             'address' => "Bandung",
             'phone' => "08122234985",
             'ktp' => "3674029293827783",
             'description' => "Menjual perhiasan",
             'picture' => "npc_wojak.png"],

             // Dropshippers
             ['name' => 'Tom',
             'email' => 'tom@gmail.com',
             'password' => Hash::make("password"),
             'role' => 2,
             'address' => "Jakarta",
             'phone' => "08122831189",
             'ktp' => "3674029293822938",
             'description' => "Menjual barang elektronik",
             'picture' => "npc_wojak.png"],

             ['name' => 'Kim',
             'email' => 'kim@gmail.com',
             'password' => Hash::make("password"),
             'role' => 2,
             'address' => "Depok",
             'phone' => "08122831127",
             'ktp' => "367402929382983874",
             'description' => "Menjual pakaian",
             'picture' => "npc_wojak.png"],

             ['name' => 'Jack',
             'email' => 'jack@gmail.com',
             'password' => Hash::make("password"),
             'role' => 2,
             'address' => "Tegal",
             'phone' => "08122812983",
             'ktp' => "36740292938291093",
             'description' => "Menjual arloji",
             'picture' => "npc_wojak.png"],

             ['name' => 'Phil',
             'email' => 'phil@gmail.com',
             'password' => Hash::make("password"),
             'role' => 2,
             'address' => "Tegal",
             'phone' => "08122938742",
             'ktp' => "36740292938214045",
             'description' => "Menjual makanan",
             'picture' => "npc_wojak.png"],

             // Admin
             ['name' => 'Admin',
             'email' => 'admin@gmail.com',
             'password' => Hash::make("password"),
             'role' => 3,
             'address' => NULL,
             'phone' => NULL,
             'ktp' => NULL,
             'description' => NULL,
             'picture' => NULL],
        ];

        DB::table('users')->insert($users);

    }
}
