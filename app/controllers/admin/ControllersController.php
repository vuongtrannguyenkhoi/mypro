<?php namespace Admin;

use Input;
use Qdesign\Repositories\Template\TemplateInterface;
use View;
use Redirect;
use Qdesign\Repositories\Controller\ControllerInterface;
use Qdesign\Services\Form\Controller\ControllerForm;
use App\Libraries\BackendController;
class ControllersController extends BackendController{


    /**
     * @var \Qdesign\Repositories\Controller\ControllerInterface
     */
    private $controller;
    /**
     * @var \Qdesign\Services\Form\Controller\ControllerForm
     */
    private $controllerForm;
    /**
     * @var TemplateInterface
     */
    private $template;

    /**
     * @param ControllerInterface $controller
     * @param ControllerForm $controllerForm
     * @param TemplateInterface $template
     */
    function __construct(ControllerInterface $controller,ControllerForm $controllerForm,TemplateInterface $template)
    {

        $this->controller = $controller;
        $this->controllerForm = $controllerForm;
        $this->template = $template;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['controllers'] = $this->controller->all();
        return View::make('admin.controllers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->data['templates'] = $this->template->all();
        return View::make('admin.controllers.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->controllerForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#controllers')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#create')
                ->withInput()
                ->withErrors( $this->controllerForm->errors() )
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
        $this->data['templates'] = $this->template->all();
        $this->data['controller'] = $this->controller->byId($id);

        return View::make('admin.controllers.edit', $this->data);
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
        if( $this->controllerForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#controllers/'.$id.'/edit')
                ->with('message', 'success');
        } else {
            return Redirect::to('admin/dashboard#controllers/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->controllerForm->errors() )
                ->with('message', 'error');
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
        $this->controller->delete($id);
        return Redirect::to('admin/dashboard#controllers');

    }
}