<?php namespace Qdesign\Models;

/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Forum extends AbstractModel{

    public function author()
    {
        return $this->belongsTo('Qdesign\Models\User','created_by');
    }
}