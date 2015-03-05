<?php
use App\Libraries\BaseController;
use Qdesign\Services\Form\Login\LoginForm;
class SessionsController extends BaseController {

	private $loginForm;
	public function __construct ( LoginForm $loginForm){
	
		$this->loginForm = $loginForm;
	}
    public function create ( ){
    
    	return View::make('sessions.create',array());
    }

    public function store()
    {
    	$input = Input::only('username','password');
    	if(!$this->loginForm->validate($input)) return Redirect::back()->withInput()->withErrors($this->loginForm->errors());
    	$remember = Input::has('remember_me') ? true : false;
    	$attempt = Auth::attempt(array(
    		'username' => $input['username'],
    		'password' => $input['password'],
    	),$remember);
        if ($attempt) {
            $role = Auth::user()->role;
            switch($role){
                //admin access url
                case 1:
                    return Redirect::to('admin/dashboard');
                    break;
                //member access url
                case 2:
                    return Redirect::to('portal/dashboard');
                    break;
                case 4:
                    return Redirect::to(route('homepage'));
                    break;
            }
            return Redirect::intended('/')->with('flash_message','You have been logged in!');
        }
    	return Redirect::back()->withInput()->with('flash_message','Invalid credentials provided');
    }

    public function destroy()
    {
    	Auth::logout();
    	return Redirect::to(route('login'));
    }

}