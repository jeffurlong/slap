<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            array(
                'id'            => 1,
                'person_id'     => 1,
                'email'      => 'admin@mvpreg.com',
                'password'      =>  Hash::make('admin'),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,

            ),
            array(
                'id'            => 2,
                'person_id'     => 2,
                'email'      => 'jef@mvpreg.com',
                'password'      =>  Hash::make('member'),
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('users')->insert($users);

    }

}
