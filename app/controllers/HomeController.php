<?php
use App\Libraries\FrontendController;
use Qdesign\Repositories\Gallery\GalleryInterface;
use Qdesign\Repositories\Post\PostInterface;

class HomeController extends FrontendController {

    /**
     * @var GalleryInterface
     */
    private $gallery;
    /**
     * @var PostInterface
     */
    private $post;

    public function __construct(GalleryInterface $gallery, PostInterface $post){
        parent::__construct();
        $this->gallery = $gallery;

        $this->post = $post;
    }
    public function getIndex(){
        $this->data['mainSlider'] = $this->gallery->byId(1);
        $this->data['featuredProjects'] = $this->post->featuredPosts(null,6);
        $this->data['box']['introduction'] = $this->box->bySlug('introduction');
        return View::make('index',$this->data);
    }

}