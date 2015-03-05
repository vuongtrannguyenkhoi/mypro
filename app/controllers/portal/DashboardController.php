<?php namespace Portal;
use View;
use App\Libraries\BackendController;
/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 10:01 PM
 */

class DashboardController extends BackendController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

        return View::make('portal.master',$this->data);
	}

    public function view(){
        return View::make('portal.index',$this->data);
    }
}