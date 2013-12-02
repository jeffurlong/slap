<?php

class PagesTableSeeder extends Seeder
{

    protected $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ac nisi at risus semper varius. Morbi mollis sapien a felis luctus, tincidunt consectetur urna placerat. Nulla sed arcu adipiscing, venenatis est ultricies, imperdiet erat. Donec diam dui, pellentesque ornare neque eu, ornare sagittis orci. Sed aliquam ultricies consectetur. Vivamus a aliquam neque. Donec vulputate, ante vitae porttitor tempor, diam lacus convallis risus, sed dignissim lectus ipsum a lectus. Duis pretium ullamcorper ante, quis ultrices lectus imperdiet sed. Phasellus ac rutrum turpis. Morbi cursus libero mauris, sed semper arcu posuere non.';

    protected $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ac nisi at risus semper varius. Morbi mollis sapien a felis luctus, tincidunt cons...';

    public function run()
    {
        DB::table('pages')->delete();

        $pages = array(
            array(
                'id'                => 1,
                'title'             => 'Home',
                'content'           => $this->content,
                'slug'              => 'home',
                'meta_title'        => 'Home',
                'meta_description'  => $this->description,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'id'                => 2,
                'title'             => 'About',
                'content'           => $this->content,
                'slug'              => 'about',
                'meta_title'        => 'About',
                'meta_description'  => $this->description,
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
        );

        DB::table('pages')->insert($pages);

    }
}
