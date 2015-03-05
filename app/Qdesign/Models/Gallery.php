<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Gallery extends AbstractModel{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'name',
        'description',
        'thumb',
        'photo',
        'active',
        'order',
    );

    public function photos(){
        return $this->hasMany('Qdesign\Models\Photo');
    }


}