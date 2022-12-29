<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\Pet;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as faker;
class ParentTable extends Seeder
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
            'addr'=> 'Earth st. Milky Way Village Galaxy City',
            'email' => 'admin@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'admin', 
            'img' => $faker->imageUrl($width = 640, $height = 480)
            ]);

            User::create([
            'fname' => 'aaron',
            'lname' => 'great',
            'addr'=> 'venus st. Milky Way Village Galaxy City',
            'email' => 'employee@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'employee',
            'deleted_at' => NOW(),
            'img' => $faker->imageUrl($width = 640, $height = 480)
            ]);


            User::create([
            'fname' => 'juan',
            'lname' => 'luna',
            'addr'=> 'saturn st. Milky Way Village Galaxy City',
            'email' => 'customer@gmail.com', 
            'password' => Hash::make('password'),
            'role' => 'customer',
            'img' => $faker->imageUrl($width = 640, $height = 480)
            ]);
        foreach(range(1,20) as $index){
            Service::create([
            'sname' => $faker->lastName(),
            'cost'=> 120,
            'simg' =>  'storage/images/anigif_sub-buzz-9709-1608056760-39_preview.gif|storage/images/download (2).jpg|storage/images/download.jpg|storage/images/images.jpg'
            ]);
        }

            Pet::create([
            'c_id' => 3,
            'pname' => $faker->Firstname($gender = 'others'|'male'|'female'),
            'ptype'=> 'Dog',
            'page'=> 1,
            'pimg' =>  'storage/images/tao.png'
            ]);



    }
}
