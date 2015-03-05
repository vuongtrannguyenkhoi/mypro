<?php namespace Qdesign\Models;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Topic extends AbstractModel{

    public function author()
    {
        return $this->belongsTo('Qdesign\Models\User','created_by');
    }

    public function forum()
    {
        return $this->belongsTo('Qdesign\Models\Forum','forum_id');
    }

    public function postedAtPresenter()
    {
        return $this->created_at->format('d-m-Y');
    }
}