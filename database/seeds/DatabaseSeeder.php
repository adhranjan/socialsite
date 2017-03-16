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

        for($i=0; $i!=10; $i++){
            $random = substr( md5(rand()), 0, 7);
            $gender=rand(1,2);
            $user=\App\User::create([
                'name'=>$random,
                'gender'=>$gender,
                'email'=>$random."@gmail.com",
                'profile_id' => md5(rand(1,999).$random.date("Y-m-d h:i:sa")),
                'password'=>bcrypt('secret'),
            ]);

            \App\Friendship::create([
                'sender'=>$user->id,
                'receiver'=>$user->id=1,
            ]);

        }

    }
}
