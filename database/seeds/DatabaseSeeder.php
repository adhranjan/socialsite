<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=>'Ranjan Adhikari',
            'gender'=>1,
            'email'=>'adh.ranjan@gmail.com',
            'profile_id' => md5(rand(1,999).'adh.ranjan@gmail.com'.date("Y-m-d h:i:sa")),
            'password'=>bcrypt('secret'),
        ]);

        \App\User::create([
            'name'=>'Sheela Adhikari',
            'gender'=>0,
            'email'=>'sheela@gmail.com',
            'profile_id' => md5(rand(1,999).'sheela@gmail.com'.date("Y-m-d h:i:sa")),
            'password'=>bcrypt('secret'),
        ]);

        \App\Friendship::create([
            'sender'=>1,
            'receiver'=>2,
        ]);
    }
}
