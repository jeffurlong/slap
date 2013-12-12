<?php namespace Slap\Repositories\Eloquent;

use Str;
use Models\Page;
use Slap\Repositories\Interfaces\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface  {

    /**
     * Create a new Page instance
     * @return \Models\Page
     */
    public function instance()
    {
        return new Page;
    }

    /**
     * Get all the models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Page::orderBy('updated_at', 'desc')->get();
    }

    /**
     * Find a Page by its primary key
     * @param  mixed $id 
     * @return \Models\Page
     */
    public function find($id)
    {
         return Page::findOrFail($id);
    }

    /**
     * Update the model in the database
     * @param  array  $input 
     * @return bool
     */
    public function update(array $input)
    {
        $model = Page::findOrFail($input['id']);

        $model->fill($input);
        
        return $this->meta($model)->save();
    }

    /**
     * Save a new page and return the instance
     * @param  array  $input 
     * @return \Models\Page
     */
    public function create(array $input)
    {
        $model = $this->meta(new Page($input));
        $model->save();
        return $model;
    }

    // public function delete($id)
    // {
    //     return Page::destroy($id);
    // }

    // public function destroy($id)
    // {
    //     return Page::findOrFail($id)->forceDelete();
    // }

    /**
     * Find a visible Page by its slug
     * @param  string $slug 
     * @return string
     */
    public function findBySlug($slug)
    {
        $slug = $slug ?: 'home';

        return Page::where('slug', $slug)->visible()->firstOrFail();
    }

    /**
     * Create model meta attribute values
     * @param  \Models\Page $model
     * @return \Models\Page
     */
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
