<?php
use App\Libraries\FrontendController;
use Qdesign\Repositories\Gallery\GalleryInterface;
class GalleriesController extends FrontendController {

    /**
     * @var GalleryInterface
     */
    private $gallery;

    public function __construct(GalleryInterface $gallery){
        parent::__construct();
        $this->gallery = $gallery;

    }
    public function getIndex(){
        $this->data['mainSlider'] = $this->gallery->byId(1);
        return View::make('index',$this->data);
    }

    public function show($slug)
    {

        $template = 'galleries.index';
        //get template
        $categorySlug = Request::segment(2);
        $this->data['category'] = $this->category->bySlug($categorySlug);
        $this->data['gallery'] = $this->gallery->byId($this->data['category']->gallery_id);
        if($this->data['category']->template){
            $template = $this->data['category']->template;
        }
        return View::make($template,$this->data);
    }

}