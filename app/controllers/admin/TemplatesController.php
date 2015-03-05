<?php namespace Admin;

use Input;
use Qdesign\Repositories\Template\TemplateInterface;
use View;
use Redirect;
use Qdesign\Services\Form\Template\TemplateForm;
use App\Libraries\BackendController;
class TemplatesController extends BackendController{


    /**
     * @var \Qdesign\Repositories\Template\TemplateInterface
     */
    private $template;
    /**
     * @var \Qdesign\Services\Form\Template\TemplateForm
     */
    private $templateForm;


    /**
     * @param TemplateInterface $template
     * @param TemplateForm $templateForm
     * @param TemplateInterface $template
     */
    function __construct(TemplateInterface $template,TemplateForm $templateForm)
    {

        $this->template = $template;
        $this->templateForm = $templateForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['templates'] = $this->template->all();
        return View::make('admin.templates.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.templates.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->templateForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#templates')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#create')
                ->withInput()
                ->withErrors( $this->templateForm->errors() )
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
        $this->data['template'] = $this->template->byId($id);

        return View::make('admin.templates.edit', $this->data);
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
        if( $this->templateForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#templates/'.$id.'/edit')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#templates/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->templateForm->errors() )
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
        $this->template->delete($id);
        return Redirect::to('admin/dashboard#templates');

    }
}