<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            array(
                'id'            => 1,
                'email'      => 'admin@mvpreg.com',
                'password'      =>  Hash::make('admin'),
                'first_name'    => 'MVP',
                'last_name'     => 'Admin',
                'phone'         => '503-555-5555',
                
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,

            ),
            array(
                'id'            => 2,
                'email'      => 'jef@mvpreg.com',
                'password'      =>  Hash::make('member'),
                'first_name'    => 'Jef',
                'last_name'     => 'Furlong',
                'phone'         => '503-801-1362',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('users')->insert($users);

    }

}
