<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(userSeeder::class);
    }
    
}

class userSeeder extends Seeder {
    public function run() {
        DB::table('users')->insert([
            ['name' => 'Khoa Pham', 'email' => str_random(5).'@gmail.com', 'password' => bcrypt('1234567')],
            ['name' => 'Laravel', 'email' => str_random(5).'@gmail.com', 'password' => bcrypt('1234568')],
            ['name' => 'PHP', 'email' => str_random(5).'@gmail.com', 'password' => bcrypt('1234569')]
        ]);
    }
}


