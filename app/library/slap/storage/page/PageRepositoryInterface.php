<?php 
namespace Slap\Storage\Page;

interface PageRepositoryInterface {

    public function findBySlug($slug);

}
