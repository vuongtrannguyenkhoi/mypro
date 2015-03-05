<?php namespace Admin;

use Input;
use View;
use Redirect;
use Qdesign\Repositories\Photo\PhotoInterface;
use Qdesign\Services\Form\Photo\PhotoForm;
use App\Libraries\BackendController;
class PhotosController extends BackendController {


    /**
     * @var \Qdesign\Repositories\Photo\PhotoInterface
     */
    private $photo;
    /**
     * @var \Qdesign\Services\Form\Photo\PhotoForm
     */
    private $photoForm;

    function __construct(PhotoInterface $photo,PhotoForm $photoForm)
    {

        $this->photo = $photo;
        $this->photoForm = $photoForm;
    }

    /**
     * @param $gallery
     * @return mixed
     */
    public function index($gallery)
    {
        $data['photos'] = $this->photo->findByGallery($gallery);
        $data['gallery'] = $gallery;
        return View::make('admin.photos.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($gallery)
    {
        $data['gallery'] = $gallery;
        return View::make('admin.photos.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($gallery)
    {
        $data['gallery_id'] = $gallery;
        if( $this->photoForm->save( array_merge(Input::all(),$data) ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#galleries/'.$gallery.'/photos')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#galleries/'.$gallery.'/photos/create')
                ->withInput()
                ->withErrors( $this->photoForm->errors() )
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
    public function edit($gallery,$id)
    {
        //
        $photo = $this->photo->byId($id);
        $data['gallery'] = $gallery;
        $data['photo'] = $photo;
        return View::make('admin.photos.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($gallery,$id)
    {
        //
        if( $this->photoForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#galleries/'.$gallery.'/photos')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#galleries/'.$gallery.'/photos/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->photoForm->errors() )
                ->with('status', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($gallery,$id)
    {
        //
        $this->photo->delete($id);
        return Redirect::to('admin/dashboard#galleries/'.$gallery.'/photos');

    }

    public function postUpdateOrder(){
        $input = Input::get();
        $this->photo->updateOrder($input['photos']);
    }
}