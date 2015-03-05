<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Template extends AbstractModel{

    public function controllers()
    {
        return $this->belongsToMany('\Qdesign\Models\Controller');
    }

}