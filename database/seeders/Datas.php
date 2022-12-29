<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as faker;

use App\Models\User;
use App\Models\Game;
use App\Models\Genre;

class Datas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        User::create([
            'fname' => 'Super',
            'lname' => 'Admin',
            'address'=> 'Earth st. Milky Way Village Galaxy City',
            'email' => 'admin@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'admin', 
            'img' => $faker->imageUrl($width = 640, $height = 480)
        ]);

        User::create([
            'fname' => 'Adam',
            'lname' => 'Shazam',
            'address'=> 'Venus st. Milky Way Village Galaxy City',
            'email' => 'employee@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'employee', 
            'img' => $faker->imageUrl($width = 640, $height = 480)
        ]);

        User::create([
            'fname' => 'Josh',
            'lname' => 'Kurt',
            'address'=> 'Earth st. Milky Way Village Galaxy City',
            'email' => 'josh.kurt@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'customer', 
            'img' => $faker->imageUrl($width = 640, $height = 480)
        ]);

        Genre::create(['genre' => 'horror']);
        Genre::create(['genre' => 'action']);
        Genre::create(['genre' => 'adventure']);
        Genre::create(['genre' => 'action-adventure']);
        Genre::create(['genre' => 'role-playing']); 
        Genre::create(['genre' => 'MMORPGs']);
        Genre::create(['genre' => 'sports simulation']); 
        Genre::create(['genre' => 'racing']); 
        Genre::create(['genre' => 'battle royale']); 
        Genre::create(['genre' => 'shooter']); 
        Genre::create(['genre' => 'survival']);
        Genre::create(['genre' => 'zombie']);

        foreach(range(1,60) as $index){

            $g_id = $index % 11;

            if($g_id == 0) {
                $g_id = 1;
            }

            Game::create([
                'title' => $faker->company(),
                'Description' => $faker->catchPhrase(),
                'stocks'=> 10,
                'price'=> 2 * $index,
                'genre_id' => $g_id, 
                'platform' => 3, 
                'img' => $faker->imageUrl($width = 640, $height = 480,'games').','.$faker->imageUrl($width = 640, $height = 480,'games')
            ]);
        }

    }
}
