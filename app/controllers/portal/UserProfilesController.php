<?php namespace Portal;
use App\Libraries\BackendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Qdesign\Repositories\UserProfile\UserProfileInterface;
use Qdesign\Services\Form\UserProfile\UserProfileForm;

class UserProfilesController extends BackendController {


    /**
     * @var \Qdesign\Repositories\UserProfile\UserProfileInterface
     */
    private $userProfile;
    /**
     * @var \Qdesign\Services\Form\UserProfile\UserProfileForm
     */
    private $userProfileForm;

    public function __construct(UserProfileInterface $userProfile,UserProfileForm $userProfileForm){
        // Closure as callback
        $this->beforeFilter(function(){
            if(!Auth::check()) {
                return Redirect::guest('login');
            }
        });
        $this->userProfile = $userProfile;
        $this->userProfileForm = $userProfileForm;
    }

    public function getUserProfile()
    {
        //find user profile\
        $this->data['userProfile'] = Auth::user()->profile;
        return View::make('portal.user-profiles.view',$this->data);
    }

    public function getCreate()
    {
        if(Auth::user()->profile)
            return Redirect::route('user_profile_path');
       return View::make('portal.user-profiles.create',$this->data);
    }

    public function getEdit()
    {
        $this->data['userProfile'] = Auth::user()->profile;
        if(!$this->data['userProfile'])
            return Redirect::route('user_profile_create_path');
        return View::make('portal.user-profiles.edit',$this->data);
    }

    public function postStore()
    {
        if( $this->userProfileForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('portal/dashboard#user/profile')
                ->with('status', 'success');
        } else {
            return Redirect::to('portal/dashboard#user/profile/create')
                ->withInput()
                ->withErrors( $this->userProfileForm->errors() )
                ->with('status', 'error');
        }
    }

    public function postUpdate()
    {
        if( $this->userProfileForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('portal/dashboard#user/profile')
                ->with('status', 'success');
        } else {
            return Redirect::to('portal/dashboard#user/profile/edit')
                ->withInput()
                ->withErrors( $this->userProfileForm->errors() )
                ->with('status', 'error');
        }
    }
}