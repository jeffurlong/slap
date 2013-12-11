<?php namespace Slap\Repositories\Eloquent;

use Models\Page as Model;

class Page implements \Slap\Repositories\Interfaces\Page  {

    public function instance()
    {
        return new Model;
    }

    public function all()
    {
        return Model::orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
         return Model::findOrFail($id);
    }

    public function update(array $input)
    {
        return Model::find($input['id'])->fill($input)->meta()->save();
    }

    public function create(array $input)
    {
        return $this->instance()->fill($input)->meta()->save();
    }

    public function findBySlug($slug)
    {
        $slug = $slug ?: 'home';

        return Model::where('slug', $slug)->first();
    }




}
