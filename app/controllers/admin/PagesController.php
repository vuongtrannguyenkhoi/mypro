<?php namespace Admin;

use Input;
use View;
use Redirect;
use Qdesign\Repositories\Page\PageInterface;
use Qdesign\Services\Form\Page\PageForm;
use App\Libraries\BackendController;
class PagesController extends BackendController {


    /**
     * @var \Qdesign\Repositories\Page\PageInterface
     */
    private $page;
    /**
     * @var \Qdesign\Services\Form\Page\PageForm
     */
    private $pageForm;

    function __construct(PageInterface $page,PageForm $pageForm)
    {

        $this->page = $page;
        $this->pageForm = $pageForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['pages'] = $this->page->all();
        return View::make('admin.pages.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->pageForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#pages')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#page/create')
                ->withInput()
                ->withErrors( $this->pageForm->errors() )
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
        $this->data['page'] = $this->page->byId($id);
        $this->data['meta'] = $this->data['page']->seo->first();
        return View::make('admin.pages.edit', $this->data);
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
        if( $this->pageForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#pages/'.$id.'/edit')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#pages/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->pageForm->errors() )
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
        $this->page->delete($id);
        return Redirect::to('admin/dashboard#pages');

    }
}