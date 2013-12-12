<?php namespace Slap\Repositories\Eloquent;

use Str;
use Models\Page;
use Slap\Repositories\Interfaces\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface  {

    public function instance()
    {
        return new Page;
    }

    public function all()
    {
        return Page::orderBy('updated_at', 'desc')->get();
    }

    public function find($id)
    {
         return Page::findOrFail($id);
    }

    public function update(array $input)
    {
        return $this->meta(Page::find($input['id'])->fill($input))->save();
    }

    public function create(array $input)
    {
        return $this->meta($this->instance()->fill($input))->save();
    }

    public function delete($id)
    {
        return Page::destroy($id);
    }

    public function destroy($id)
    {
        return Page::findOrFail($id)->forceDelete();
    }

    public function findBySlug($slug)
    {
        $slug = $slug ?: 'home';

        return Page::where('slug', $slug)->firstOrFail();
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
