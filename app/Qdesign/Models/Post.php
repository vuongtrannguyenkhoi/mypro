<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Post extends AbstractModel{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'slug',
        'photo',
        'thumb',
        'description',
        'content',
        'category_id',
        'status',
        'featured',
        'pubdate',
    );

    public function category()
    {
        return $this->belongsTo('\Qdesign\Models\Category');
    }

    public function photos()
    {
        return $this->hasMany('\Qdesign\Models\Photo','gallery_id','gallery_id');
    }

    public function author()
    {
        return $this->belongsTo('\Qdesign\Models\User','created_by');
    }

    public function seo()
    {
        return $this->morphMany('\Qdesign\Models\Seo', 'seoble');
    }

}