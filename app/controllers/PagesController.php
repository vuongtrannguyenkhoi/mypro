<?php
use App\Libraries\FrontendController;
use Qdesign\Repositories\Category\CategoryInterface;
use Qdesign\Repositories\Page\PageInterface;
class PagesController extends FrontendController {

    /**
     * @var PageInterface
     */
    private $page;

    public function __construct(PageInterface $page,CategoryInterface $category){
        parent::__construct();
        $this->page = $page;
        $this->category = $category;
    }
    /**
     * @param null $slug
     */
    public function show($slug)
    {
        $categorySlug = Request::segment(2);

        $template = 'pages.index';
        //get template
        $category = $this->category->bySlug($categorySlug);
        $this->data['page'] = $this->page->byId($category->page_id);

        if($category->template){
            $template = $category->template;
        }
        switch($template){

            case 'pages.contact':
                $this->data['box']['lien-he-left'] = $this->box->bySlug('lien-he-left');
                $this->data['box']['google-map'] = $this->box->bySlug('google-map');
                $this->data['box']['lien-he-right'] = $this->box->bySlug('lien-he-right');
                break;
        }
        $this->data['meta'] = $this->data['page']->seo->first();
        return View::make($template,$this->data);
    }


}