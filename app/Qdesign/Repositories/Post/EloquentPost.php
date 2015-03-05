<?php namespace Qdesign\Repositories\Post;

use DB;
use Input;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
class EloquentPost extends RepositoryAbstract implements PostInterface {
    /**
     * @var string
     */
    public static $path = 'upload/media/images/post/';
    public static $thumb_w = 360;
    public static $thumb_h = 290;
    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $post)
    {
        $this->model = $post;
    }

    public function all(){
        return $this->model
                    ->orderBy('pubdate','desc')
                    ->orderBy('name','asc')
                    ->get();
    }

    public function allByCategorySlug($category_slug){
        return DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.name',
                'posts.slug',
                'posts.content',
                'users.username as author',
            ))
            ->join('categories',function($join)use($category_slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$category_slug);
            })
            ->join('users','users.id','=','posts.created_by')
        ->orderBy('order')
        ->orderBy('pubdate','desc')
        ->orderBy('name','asc')
        ->get();

    }

    public function relatedPostsByCategoryId($category_id,$n = 3)
    {
        return DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.thumb',
                'posts.name',
                'posts.slug',
                'posts.description',
            ))
            ->where('posts.category_id','=',$category_id)
            ->orderBy('order')
        ->orderBy('pubdate','desc')
        ->orderBy('name','asc')
            ->limit($n)
            ->get();
    }
    public function byId($id)
    {
       return $this->find($id);
    }
    public function bySlug($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }


    public function create(array $data)
    {
        $dataImg = $this->uploadImage('file');
        $dataFeaturedImg = $this->uploadImage('file-featured-photo',620,390);
        if(!empty($dataFeaturedImg)){
            $featuredImg['featured_photo'] = $dataFeaturedImg['photo'];
            $featuredImg['featured_thumb'] = $dataFeaturedImg['thumb'];
            $dataImg = array_merge($dataImg,$featuredImg);
        }
        unset($data['file']);
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $post = $this->model->create(array_merge($data,$dataImg));

        if( ! $post )
        {
            return false;
        }
        //SEO
        $seo = $this->saveSeo($data);
        $post->seo()->save($seo);
        return true;
    }

    public function update(array $data)
    {
        $post = $this->find($data['id']);
        $fields = array(
            'name',
            'slug',
            'thumb',
            'photo',
            'featured_thumb',
            'featured_photo',
            'description',
            'content',
            'price',
            'materials',
            'status',
            'category_id',
            'gallery_id',
            'pubdate',
            'event_date',
            'featured',
        );
        $dataImg = $this->uploadImage('file');
        $dataFeaturedImg = $this->uploadImage('file-featured-photo',620,390);
        if(!empty($dataFeaturedImg)){
            $featuredImg['featured_photo'] = $dataFeaturedImg['photo'];
            $featuredImg['featured_thumb'] = $dataFeaturedImg['thumb'];
            $dataImg = array_merge($dataImg,$featuredImg);
        }

        unset($data['file']);
        unset($data['file-featured-photo']);
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $post->myUpdate($fields,array_merge($data,$dataImg));
        $post->save();
        //seo
        $seo = $post->seo->first();
        $seo->title = $data['site_title'];
        $seo->description = $data['site_meta_description'];
        $seo->keywords = $data['site_meta_keywords'];
        $seo->save();

        return true;
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new PostNotFoundException('the post with id='.$this->id.' not found');
        return $this->modelInstance;
    }

    public function byCategorySlug($page=1, $limit=10,$slug){
        $result = new EloquentPost($this->model);
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.name',
                'posts.slug',
                'posts.created_at',
                'posts.status',
                'users.username as author',
            ))
            ->join('categories',function($join)use($slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$slug);
            })
            ->leftJoin('users','users.id','=','posts.created_by')
            ->orderBy('order')
        ->orderBy('created_at','desc')
        ->orderBy('name','asc');

        $posts = $query->skip( $limit * ($page-1) )
            ->take($limit)
            ->get();
        $result->totalItems = DB::table('posts')
            ->join('categories',function($join)use($slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$slug);
            })->count();
        $result->items = $posts;

        return $result;
    }
    private function uploadImage($fileName,$thumb_w=null,$thumb_h=null){
        $dataImg = array();
        if(!Input::hasFile($fileName))
            return $dataImg;
        $file = Input::file($fileName);
        $extension = $file->getClientOriginalExtension();
        $filename = sha1(time().time()).".{$extension}";

        $destinationPath = self::$path;

        //upload
        Image::make($file->getRealPath())->save($destinationPath.$filename);
        //resize
        $filename_x_x = 'thumb_'.$filename;
        if(!$thumb_w || !$thumb_h){
            $thumb_w = self::$thumb_w;
            $thumb_h = self::$thumb_h;
        }
        Image::make( $destinationPath.$filename )->resize($thumb_w,$thumb_h)->save( $destinationPath.$filename_x_x );
        $data['photo'] = self::$path.$filename;
        $data['thumb'] = self::$path.$filename_x_x;
        return $data;
    }

    public function publishedPosts( $page,  $limit,  $category_slug = null)
    {
        if(!$category_slug)
            throw new CategorySlugNotNullFoundException('category_slug not NULL');
        $result = new EloquentPost($this->model);
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.name',
                'posts.slug',
                'posts.thumb',
                'posts.description',
                'categories.slug as category_slug',
            ))
            ->join('categories',function($join)use($category_slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$category_slug);
            })->orderBy('order')
        ->orderBy('pubdate','desc')
        ->orderBy('name','asc');

        $posts = $query->skip( $limit * ($page-1) )
            ->where('status','=','published')
            ->take($limit)
            ->get();
        $result->totalItems = DB::table('posts')
            ->join('categories',function($join)use($category_slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$category_slug);
            })
            ->where('status','=','published')
            ->count();
        $result->items = $posts;
        return $result;
    }

    public function allPublishedPostByCategorySlug($category_slug)
    {
        return DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.name',
                'posts.slug',
                'posts.thumb',
                'posts.description',
                'posts.pubdate',
                'posts.content',
                'categories.slug as parent_slug',
            ))
            ->join('categories',function($join)use($category_slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$category_slug);
            })
            ->where('status','=','published')
            ->orderBy('order')
        ->orderBy('pubdate','desc')
        ->orderBy('name','asc')
            ->get();
    }

    public function newPosts($slug,$limit = 6){
        $query = DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.slug',
                'posts.name',
                'posts.thumb',
            ))
            ->join('categories',function($join)use($slug){
                $join->on('categories.id','=','posts.category_id')
                    ->where('categories.slug','=',$slug);
            });

        $posts = $query
            ->where('status','=','published')
            ->take($limit)
            ->orderBy('order')
        ->orderBy('pubdate','desc')
        ->orderBy('name','asc')
            ->get();
        return $posts;
    }
    public function featuredPosts($slug = null,$limit = 6){
        $query = DB::table('posts')
            ->select(array(
                'posts.id',
                'posts.slug',
                'posts.name',
                'posts.thumb',
                'posts.featured_thumb',
                'posts.event_date',
                'categories.controller',
                'categories.slug as category_slug',
            ))
            ->join('categories',function($join)use($slug){
                    $join = $join->on('categories.id','=','posts.category_id');
                if($slug)
                    $join->where('categories.slug',$slug);
            });

        $posts = $query
            ->where('status','=','published')
            ->where('featured','=',true)
            ->take($limit)
            ->orderBy('order')
            ->orderBy('pubdate','desc')
            ->orderBy('name','asc')
            ->get();
        return $posts;
    }
    public function getLatestPostsLimitBy($number = 6){
        return $this->model
            ->where('status','=','published')
            ->orderBy('pubdate','desc')
            ->orderBy('name','asc')
            ->take($number)
            ->get();
    }
}
