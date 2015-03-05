<?php namespace Qdesign\Models;

/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class UserProfile extends AbstractModel{

    public function user()
    {
        return $this->belongsTo('Qdesign\Models\User','user_id');
    }


    //presenter of thumb to display avata of user
    public function avata()
    {
        if(!$this->thumb)
            return '<img src="'.url('frontend/images/default-avata.png').'"/>';
        return "<img
        src='".url($this->thumb)."'
        width='50'>";
    }
}