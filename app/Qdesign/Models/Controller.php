<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Controller extends AbstractModel{

    /**
     * @var array
     */
    protected $fillable = array(
        'controller',
        'name',
        'description',
    );

    public function templates()
    {
        return $this->belongsToMany('\Qdesign\Models\Template');
    }

}