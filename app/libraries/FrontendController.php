<?php namespace App\Libraries;
use Qdesign\Models\Box;
use Qdesign\Repositories\Box\EloquentBox;
use Qdesign\Repositories\Siteconfig\EloquentSiteconfig;
use Qdesign\Repositories\Category\EloquentCategory;
use Qdesign\Repositories\Photo\EloquentPhoto;
use Qdesign\Models\Siteconfig;
use Qdesign\Models\Category;
use Qdesign\Models\Photo;
class FrontendController extends BaseController {

    protected $box;
    protected $siteconfig;
    protected $category;
    protected $photo;

    public function __construct(){
        $this->box = new EloquentBox(new Box);
        $this->siteconfig = new EloquentSiteconfig(new Siteconfig);
        $this->category = new EloquentCategory(new Category);
        $this->photo = new EloquentPhoto(new Photo);
        //
        $this->init();
    }

    private function init(){

        $this->data['siteconfig'] = $this->siteconfig->first();
        $this->data['meta'] = new \stdClass();
        $this->data['meta']->title = $this->data['siteconfig']->site_title;
        $this->data['meta']->description = $this->data['siteconfig']->site_meta_description;
        $this->data['meta']->keywords = $this->data['siteconfig']->site_meta_keywords;
        //categories

        $this->data['categories'] = $this->category->getFrontEndCategories();
        //

        $this->data['box']['logo'] = $this->box->bySlug('logo');
        $this->data['box']['copyright'] = $this->box->bySlug('copyright');
        $this->data['box']['links'] = $this->box->bySlug('links');
    }
}