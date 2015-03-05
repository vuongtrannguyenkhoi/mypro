<?php namespace Admin;

use Input;
use Qdesign\Repositories\Gallery\GalleryInterface;
use View;
use Redirect;
use Session;
use Paginator;
use Qdesign\Repositories\Post\PostInterface;
use Qdesign\Repositories\Category\CategoryInterface;
use Qdesign\Services\Form\Post\PostForm;
use App\Libraries\BackendController;
class PostsController extends BackendController {


    /**
     * @var \Qdesign\Repositories\Post\PostInterface
     */
    private $post;
    /**
     * @var \Qdesign\Services\Form\Post\PostForm
     */
    private $postForm;
    /**
     * @var CategoryInterface
     */
    private $category;
    /**
     * @var \Qdesign\Repositories\Gallery\GalleryInterface
     */
    private $gallery;

    function __construct(PostInterface $post,CategoryInterface $category,GalleryInterface $gallery,PostForm $postForm)
    {

        $this->post = $post;
        $this->postForm = $postForm;
        $this->category = $category;
        $this->gallery = $gallery;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['query_string'] = \Request::query();
        Session::set('return_query_string',$data['query_string']);
        unset($data['query_string']['page']);
        Session::set('last_query_string',$data['query_string']);
        $category_slug = Input::get('topic');
        Session::set('topic',$category_slug);
        $page = Input::get('page', 1);

        // Candidate for config item
        $perPage = 12;
        $pagiData = $this->post->byCategorySlug($page,$perPage, $category_slug);
        $data['posts'] = Paginator::make($pagiData->items, $pagiData->totalItems, $perPage);
        $data['posts']->setBaseUrl('#posts');
        return View::make('admin.posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['template'] = $this->category->bySlug(Session::get('topic'))->template;

        $this->data['categories'] = $this->category->all();
        $this->data['galleries'] = $this->gallery->all();
        $this->data['statuses'] = array(
            'unpublished'=>'Unpublished',
            'published'=>'Published'
        );
        return View::make('admin.posts.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();
        $input['featured'] = isset($input['featured']) ? true: false;
        if( $this->postForm->save( $input ) )
        {
            // Success!
            $s = Session::get('return_query_string');
            return Redirect::to('admin/dashboard#posts?'.http_build_query($s ))
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#posts/create')
                ->withInput()
                ->withErrors( $this->postForm->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->data['template'] = $this->category->bySlug(Session::get('topic'))->template;
        $this->data['categories'] = $this->category->all();
        $this->data['galleries'] = $this->gallery->all();
        $this->data['post'] = $this->post->byId($id);
        $this->data['statuses'] = array(
            'unpublished'=>'Unpublished',
            'published'=>'Published'
        );
        return View::make('admin.posts.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
        $input = Input::all();
        $input['featured'] = isset($input['featured']) ? true: false;
        if( $this->postForm->update( $input ))
        {
            // Success!
            return Redirect::to('admin/dashboard#posts/'.$id.'/edit')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#posts/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->postForm->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $this->post->delete($id);
        $s = Session::get('return_query_string');
        return Redirect::to('admin/dashboard#posts?'.http_build_query($s ));

    }
}