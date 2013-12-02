<?php

class PeopleTableSeeder extends Seeder {

    public function run()
    {
        DB::table('people')->delete();

        $people = array(
            array(
                'id'            => 1,
                'master_id'     => 1,
                'first_name'    => 'MVP',
                'last_name'     => 'Admin',
                'email'         => 'admin@mvpreg.com',
                'phone'         => '503-555-5555',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'id'            => 2,
                'master_id'     => 2,
                'first_name'    => 'Jef',
                'last_name'     => 'Furlong',
                'email'         => 'jef@mvpreg.com',
                'phone'         => '503-801-1362',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('people')->insert($people);

    }
}
