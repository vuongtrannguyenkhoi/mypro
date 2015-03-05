<?php
use App\Libraries\FrontendController;
use Qdesign\Models\Post;

class SearchController extends FrontendController {



    public function __construct(){
        parent::__construct();

    }

    public function getQuery()
    {
        $q =  strtolower(Input::get('q'));
        if($q =='')
            $this->data['posts'] = array();
        else
        {
            $this->data['posts'] = Post::select(array(
                'posts.id',
                'posts.slug',
                'posts.thumb',
                "posts.name",
                "posts.order",
                "categories.name as category_name",
                'categories.slug as category_slug',
            ))
                ->join('categories','posts.category_id','=','categories.id')
                ->where('categories.slug','<>','tin-tuc')
                ->where('posts.status','=','published')
                ->where('posts.name', 'LIKE', "%{$q}%")
                ->orderBy('order')
                ->orderBy('pubdate','desc')
                ->orderBy('name')
                ->get();
        }

        return View::make('search.results',$this->data);
    }
}