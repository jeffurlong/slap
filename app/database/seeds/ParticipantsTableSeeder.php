<?php

class ParticipantsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('participants')->delete();

        $data = array(
            array(
                'id'            => 1,
                'parent_id'     => 2,
                'first_name'    => 'Jack',
                'last_name'     => 'Furlong',
                'gender'         => 'M',
                'dob'         => '2004-01-03',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'id'            => 2,
                'master_id'     => 2,
                'first_name'    => 'Casey',
                'last_name'     => 'Furlong',
                'gender'         => 'F',
                'dob'         => '2006-07-23',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('participants')->insert($data);

    }
}
