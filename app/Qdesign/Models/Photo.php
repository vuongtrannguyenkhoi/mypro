<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Photo extends AbstractModel{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'thumb',
        'photo',
        'link',
        'description',
        'active',
        'order',
        'gallery_id',
    );



}