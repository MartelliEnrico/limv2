<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        LimManager\Entities\User::create([
            'username' => 'bel22216',
            'password' => '123456',
            'first_name' => 'Enrico',
            'last_name' => 'Martelli',
            'group' => 'student'
        ]);

        LimManager\Entities\User::create([
            'username' => 'sica.annamaria',
            'password' => '123456',
            'first_name' => 'Annamaria',
            'last_name' => 'Sica',
            'group' => 'teacher'
        ]);

        LimManager\Entities\User::create([
            'username' => 'master',
            'password' => '123456',
            'first_name' => '',
            'last_name' => '',
            'group' => 'admin'
        ]);
    }

}