<?php namespace Models;

class Page extends \Eloquent {

    protected $guarded = array('id');

    // =========================================================================
    // SCOPES
    // =========================================================================

    /**
     * Limit the query to visible pages
     * @param   \Illuminate\Database\Eloquent\Builder
     * @return  \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->whereVisible('1');
    }

}
