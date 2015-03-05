<?php
use App\Libraries\FrontendController;
use Qdesign\Services\Form\Member\Register\RegisterForm;
use Qdesign\Services\Form\User\UserForm;

class MembersController extends FrontendController {



    private $registerForm;
    /**
     * @var UserForm
     */
    private $userForm;

    public function __construct(RegisterForm $registerForm,UserForm $userForm){
        parent::__construct();
        $this->registerForm = $registerForm;
        $this->userForm = $userForm;
    }

    public function getRegister()
    {
        return View::make('members.register',$this->data);
    }

    public function postRegister()
    {
        if(!$this->registerForm->validate(Input::all()))
            return Redirect::back()->withInput()->withErrors($this->registerForm->errors());

        $input = Input::only('username','email','password');
        $input['password_confirmation'] = $input['password'];
        $input['created_by'] = 0;
        $input['status'] = 1;
        if( $this->userForm->save( $input ) )
        {
            // Success!
            return Redirect::to(url())
                ->with('status', 'success');
        } else {

            return Redirect::back()
                ->withInput()
                ->withErrors( $this->userForm->errors() )
                ->with('status', 'error');
        }
    }

    public function getLogin()
    {
        return View::make('members.login',$this->data);
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to(url('dang-nhap'));
    }
}