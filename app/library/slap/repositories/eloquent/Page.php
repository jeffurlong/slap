<?php namespace Slap\Repositories\Eloquent;

use Str;
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
        return $this->meta(Model::find($input['id'])->fill($input))->save();   
    }

    public function create(array $input)
    {
        return $this->meta($this->instance()->fill($input))->save();
    }

    public function delete($id)
    {
        return Model::destroy($id);
    }

    public function destroy($id)
    {
        return Model::findOrFail($id)->forceDelete();
    }

    public function findBySlug($slug)
    {
        $slug = $slug ?: 'home';

        return Model::where('slug', $slug)->firstOrFail();
    }

    private function meta($model)
    {
        if ( ! $model->isDirty('meta_title'))
        {
            $model->meta_title = substr($model->title, 0, 60);
        }

        if ( ! $model->isDirty('meta_description'))
        {
            $model->meta_description = substr(strip_tags(str_replace ('>', '> ', $model->content)), 0, 150).'...';
        }
        
        if( ! $model->exists)
        {
            $model->slug = Str::slug($model->title);
        }

        return $model;
    }

}
