<?php

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();

        $settings = array(
            array(
                'id' => 'name',
                'value' => 'Demo Sports League',
            ),
            array(
                'id' => 'slug',
                'value' => 'demo',
            ),
            array(
                'id' => 'active',
                'value' => 'false'
            ),
            array(
                'id' => 'theme',
                'value' => '',
            ),
            array(
                'id' => 'payment_processor',
                'value' => 'authnet',
            ),
            array(
                'id' => 'authnet_api_login',
                'value' => 'FAKE',
            ),
            array(
                'id' => 'authnet_transaction_key',
                'value' => 'FAKE',
            ),
            array(
                'id' => 'email',
                'value' => 'fakeee@faker.com',
            ),
            array(
                'id' => 'phone',
                'value' => '555-555-5555',
            ),
            array(
                'id' => 'street',
                'value' => '',
            ),
            array(
                'id' => 'city',
                'value' => '',
            ),
            array(
                'id' => 'state',
                'value' => '',
            ),
            array(
                'id' => 'zip',
                'value' => '',
            ),
        );

        DB::table('settings')->insert($settings);
    }

}
