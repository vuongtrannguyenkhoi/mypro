<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Page extends AbstractModel{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'slug',
        'description',
        'content',
    );

    public function author()
    {
        return $this->belongsTo('\Qdesign\Models\User','created_by');
    }

    public function seo()
    {
        return $this->morphMany('\Qdesign\Models\Seo', 'seoble');
    }
}