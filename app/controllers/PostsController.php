<?php
use App\Libraries\FrontendController;
use Qdesign\Models\Post;
use Qdesign\Repositories\Box\BoxInterface;
use Qdesign\Repositories\Gallery\GalleryInterface;
use Qdesign\Repositories\Page\PageInterface;
use Qdesign\Repositories\Post\PostInterface;
use Qdesign\Repositories\Category\CategoryInterface;
class PostsController extends FrontendController {

    /**
     * @var PageInterface
     */
    private $post;
    /**
     * @var Qdesign\Repositories\Category\CategoryInterface
     */
    protected $category;
    /**
     * @var GalleryInterface
     */
    private $gallery;


    public function __construct(PostInterface $post,CategoryInterface $category,GalleryInterface $gallery){
        parent::__construct();
        $this->post = $post;
        $this->category = $category;
        $this->gallery = $gallery;
    }

    public function index(){
        $category = last(Request::segments());
        $this->data['category'] = $this->category->bySlug($category);

        $this->data['posts'] = DB::table('view_parent_posts')
            ->where('parent_slug',$category)
            ->where('status','published')
            ->orderBy('pubdate','desc')
            ->orderBy('name')
            ->paginate(9);
        $this->data['parentCategory'] = DB::table('view_parents')
            ->where('slug','=',Request::segment(2))
            ->first();
        $this->data['subCategories'] = $this->category->children($this->data['parentCategory']->slug);
        if($this->data['category']->template){
            $template = $this->data['category']->template.'.index';
        }

        return View::make($template,$this->data);
    }

    public function show($category,$id)
    {
        $template = 'posts.detail';
        $this->data['post'] = $this->post->byId($id);
        $this->data['category'] = $this->category->byId($this->data['post']->category_id);
        $this->data['currentCategory'] = DB::table('view_parents')
            ->where('slug','=',$category)
            ->first();
        $this->data['parentCategory'] = DB::table('view_parents')
            ->where('slug','=',$this->data['currentCategory']->parent_slug)
            ->first();
        $this->data['subCategories'] = $this->category->children($this->data['parentCategory']->slug);
        if($this->data['category']){
            $template = $this->data['category']->template .'.detail';
        }
        return View::make($template,$this->data);
    }

    public function featuredPosts()
    {
        $this->data['posts'] = Post::select(array(
            'posts.id',
            'posts.slug',
            'posts.thumb',
            "posts.name",
            "categories.name as category_name",
            'categories.slug as category_slug',
        ))
            ->join('categories','posts.category_id','=','categories.id')
            ->where('posts.status','=','published')
            ->where('posts.featured','=',true)
            ->orderBy('order')
            ->orderBy('pubdate','desc')
            ->orderBy('name','asc')
            ->paginate(9);
        return View::make('posts.products.index',$this->data);
    }

    public function newsPosts()
    {
        $this->data['posts'] = Post::select(array(
            'posts.id',
            'posts.slug',
            'posts.thumb',
            "posts.name",
            "categories.name as category_name",
            'categories.slug as category_slug',
        ))
            ->join('categories','posts.category_id','=','categories.id')
            ->where('categories.slug','=','tin-tuc')
            ->where('posts.status','=','published')
            ->orderBy('order')
            ->orderBy('pubdate','desc')
            ->orderBy('name','asc')
            ->paginate(9);
        return View::make('posts.news.index',$this->data);
    }

    public function showNews($id)
    {
        $this->data['post'] = Post::select(array(
            'posts.id',
            'posts.slug',
            'posts.thumb',
            "posts.name",
            "posts.description",
            "posts.content",
            "categories.name as category_name",
            'categories.slug as category_slug',
        ))
            ->join('categories','posts.category_id','=','categories.id')
            ->where('posts.id','=',$id)
            ->where('posts.status','=','published')
            ->orderBy('order')
            ->orderBy('pubdate','desc')
            ->orderBy('name','asc')
            ->first();
        return View::make('posts.news.detail',$this->data);
    }

}