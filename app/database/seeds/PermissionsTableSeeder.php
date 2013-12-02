<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            array(
                'name'          => 'manage_users',
                'display_name'  => 'Manage Users',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'manage_settings',
                'display_name'  => 'Manage Settings',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'manage_pages',
                'display_name'  => 'Manage Pages',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
            array(
                'name'          => 'manage_admins',
                'display_name'  => 'Manage Admins',
                'created_at'    => new DateTime,
                'updated_at'    => new DateTime,
            ),
        );

        DB::table('permissions')->insert($permissions);

        DB::table('permission_role')->delete();

        $permission_roles = array(
            array(
                 'role_id' => 2,
                 'permission_id' => 1,
            ),
            array(
                 'role_id' => 2,
                 'permission_id' => 2,
            ),
            array(
                 'role_id' => 2,
                 'permission_id' => 3,
            ),
        );

        DB::table('permission_role')->insert($permission_roles);
    }
}
