<?php namespace Admin;

use Input;
use View;
use Redirect;
use Qdesign\Repositories\Box\BoxInterface;
use Qdesign\Services\Form\Box\BoxForm;
use App\Libraries\BackendController;
class BoxesController extends BackendController{


    /**
     * @var \Qdesign\Repositories\Box\BoxInterface
     */
    private $box;
    /**
     * @var \Qdesign\Services\Form\Box\BoxForm
     */
    private $boxForm;

    function __construct(BoxInterface $box,BoxForm $boxForm)
    {

        $this->box = $box;
        $this->boxForm = $boxForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['boxes'] = $this->box->all();
        return View::make('admin.boxes.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.boxes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->boxForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#boxes')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#create')
                ->withInput()
                ->withErrors( $this->boxForm->errors() )
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
        $box = $this->box->byId($id);
        return View::make('admin.boxes.edit',array('box'=>$box));
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
        if( $this->boxForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#boxes/'.$id.'/edit')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#boxes/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->boxForm->errors() )
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
        $this->box->delete($id);
        return Redirect::to('admin/dashboard#boxes');

    }
}