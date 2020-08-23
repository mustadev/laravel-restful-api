<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // remove old records
        User::truncate();

        // instantiate faker
        $faker = \Faker\Factory::create();

        //create a hashed password
        $password = Hash::make('password');

        //create admin

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => $password
        ]);
        // add records

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);
        }

    }
}
