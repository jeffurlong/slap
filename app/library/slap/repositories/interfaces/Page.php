<?php namespace Slap\Repositories\Interfaces;

interface Page {

    public function instance();
    public function all();
    public function find($id);
    public function update(array $input);
    public function create(array $input);
    public function delete($id);
    public function destroy($id);
    
    public function findBySlug($slug);
}
