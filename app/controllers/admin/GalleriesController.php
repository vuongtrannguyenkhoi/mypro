<?php namespace Admin;

use Input;
use View;
use Redirect;
use Qdesign\Repositories\Gallery\GalleryInterface;
use Qdesign\Services\Form\Gallery\GalleryForm;
use App\Libraries\BackendController;
class GalleriesController extends BackendController {


    /**
     * @var \Qdesign\Repositories\Gallery\GalleryInterface
     */
    private $gallery;
    /**
     * @var \Qdesign\Services\Form\Gallery\GalleryForm
     */
    private $galleryForm;

    function __construct(GalleryInterface $gallery,GalleryForm $galleryForm)
    {

        $this->gallery = $gallery;
        $this->galleryForm = $galleryForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['galleries'] = $this->gallery->all();
        return View::make('admin.galleries.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->galleryForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#galleries')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#galleries/create')
                ->withInput()
                ->withErrors( $this->galleryForm->errors() )
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
        $gallery = $this->gallery->byId($id);
        return View::make('admin.galleries.edit',array('gallery'=>$gallery));
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
        if( $this->galleryForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#galleries/'.$id.'/edit')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#galleries/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->galleryForm->errors() )
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
        $this->gallery->delete($id);
        return Redirect::to('admin/dashboard#galleries');

    }
}