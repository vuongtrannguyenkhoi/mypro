<?php namespace Qdesign\Models;
class Seo extends AbstractModel{
    protected $table = 'seo';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'title',
        'description',
        'keywords',
    );

    public function seoble()
    {
        return $this->morphTo();
    }
}