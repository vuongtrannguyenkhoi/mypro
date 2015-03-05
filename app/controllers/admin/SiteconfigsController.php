<?php namespace Admin;

use Input;
use View;
use Redirect;
use Qdesign\Repositories\Siteconfig\SiteconfigInterface;
use Qdesign\Services\Form\Siteconfig\SiteconfigForm;
use App\Libraries\BackendController;
class SiteconfigsController extends BackendController {


    /**
     * @var \Qdesign\Repositories\Siteconfig\SiteconfigInterface
     */
    private $siteconfig;
    /**
     * @var \Qdesign\Services\Form\Siteconfig\SiteconfigForm
     */
    private $siteconfigForm;

    function __construct(SiteconfigInterface $siteconfig,SiteconfigForm $siteconfigForm)
    {

        $this->siteconfig = $siteconfig;
        $this->siteconfigForm = $siteconfigForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $siteconfig = $this->siteconfig->first();
        return View::make('admin.siteconfigs.edit',array('siteconfig'=>$siteconfig));
    }

    public function postSave(){
        //
        if( $this->siteconfigForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#siteconfigs')
                ->with('status', 'success');
        } else {

        }
    }
}