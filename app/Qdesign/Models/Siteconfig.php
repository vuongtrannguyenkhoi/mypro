<?php namespace Qdesign\Models;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Siteconfig extends AbstractModel{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'site_title',
        'site_meta_description',
        'site_meta_keywords',
        'site_name',
        'pagination_perpage',
        'company_name',
        'company_address',
        'company_phone',
        'company_website',
        'company_receive_email',
    );

}