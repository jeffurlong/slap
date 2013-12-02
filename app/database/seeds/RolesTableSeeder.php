<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $roles = array(
            array(
                'name'          => 'owner',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'admin',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'member',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('roles')->insert($roles);

        DB::table('role_user')->delete();

        $assigned_roles = array(
            array(
                 'user_id' => 1,
                 'role_id' => 1,
            ),
            array(
                 'user_id' => 1,
                 'role_id' => 2,
            ),
            array(
                 'user_id' => 2,
                 'role_id' => 3,
            ),
        );

        DB::table('role_user')->insert($assigned_roles);
    }
}
