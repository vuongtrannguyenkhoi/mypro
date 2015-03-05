<?php namespace Admin;
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

		return View::make('admin.master',$this->data);
	}

    public function view()
    {
        return View::make('admin.index',$this->data);
    }
}