<?php namespace Admin;

use Input;
use Qdesign\Repositories\Controller\ControllerInterface;
use Qdesign\Repositories\Gallery\GalleryInterface;
use Qdesign\Repositories\Page\PageInterface;
use View;
use Redirect;
use Qdesign\Repositories\Category\CategoryInterface;
use Qdesign\Services\Form\Category\CategoryForm;
use App\Libraries\BackendController;
class CategoriesController extends BackendController{


    /**
     * @var \Qdesign\Repositories\Category\CategoryInterface
     */
    private $category;
    /**
     * @var \Qdesign\Services\Form\Category\CategoryForm
     */
    private $categoryForm;
    /**
     * @var PageInterface
     */
    private $page;
    /**
     * @var GalleryInterface
     */
    private $gallery;
    /**
     * @var ControllerInterface
     */
    private $controller;

    /**
     * @param CategoryInterface $category
     * @param CategoryForm $categoryForm
     * @param PageInterface $page
     * @param GalleryInterface $gallery
     * @param ControllerInterface $controller
     */
    function __construct(CategoryInterface $category,CategoryForm $categoryForm,PageInterface $page,GalleryInterface $gallery,ControllerInterface $controller)
    {

        $this->category = $category;
        $this->categoryForm = $categoryForm;
        $this->page = $page;
        $this->gallery = $gallery;
        //

        $this->controller = $controller;

        $this->data['controllers'] = $this->controller->all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['categories'] = $this->category->all();
        return View::make('admin.categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['categories'] = $this->category->all();

        return View::make('admin.categories.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->categoryForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#categories')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#categories/create')
                ->withInput()
                ->withErrors( $this->categoryForm->errors() )
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
        //
        $this->data['category'] = $this->category->byId($id);

        return View::make('admin.categories.edit', $this->data);
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
        if( $this->categoryForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#categories/'.$id.'/edit')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#categories/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->categoryForm->errors() )
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
        $this->category->delete($id);
        return Redirect::to('admin/dashboard#categories');
    }

    public function getOrder(){

        return View::make('admin.categories.order');
    }

    public function getModalOrder()
    {
        return View::make('admin.categories.modal-order');
    }
    public function postOrderAjax ( ){
        $input = Input::all();

        //save order from ajax call
        if ( isset( $input['sortable'] ) ) {
            $this->category->updateOrder( $input['sortable'] );
        }

        $data['categories'] = $this->category->all();
        return View::make('admin.categories.orderAjax',$data);
    }

    public function getTemplate($controller)
    {
        $data = Input::all();
        $data['templates'] = $this->controller->byController($controller)->templates;
        switch($controller){
            case 'pages':
                $data['pages'] = $this->page->all();
                return View::make('admin.categories.templates.page-template',$data);
                break;
            case 'galleries':
                $data['galleries'] = $this->gallery->all();
                return View::make('admin.categories.templates.gallery-template',$data);
                break;
            case 'posts':
                $data['galleries'] = $this->gallery->all();
                return View::make('admin.categories.templates.post-template',$data);
                break;
            case 'products':
                $data['galleries'] = $this->gallery->all();
                return View::make('admin.categories.templates.product-template',$data);
                break;
            case 'projects':
                return View::make('admin.categories.templates.project-template',$data);
                break;
            case 'ourServices':
                $data['galleries'] = $this->gallery->all();
                return View::make('admin.categories.templates.our-service-template',$data);
                break;
        }

        return 'empty';
    }
}