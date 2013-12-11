<?php namespace Models;

use Str;

class Page extends \Eloquent {

    protected $fillable = array('title', 'content', 'visible');

    public function meta()
    {
        $this->slug = Str::slug($this->title);
        $this->meta_title = substr($this->title, 0, 60);
        $this->meta_description =
            substr(strip_tags(str_replace ('>', '> ', $this->content)), 0, 150).'...';

        return $this;
    }

}
