<?php
use Intervention\Image\Image;
use Qdesign\Repositories\Profile\ProfileInterface;
use Qdesign\Services\Form\Profile\ProfileForm;
use App\Libraries\BackendController;
class ProfilesController extends BackendController {

    /**
     * @var Qdesign\Repositories\Profile\ProfileInterface
     */
    private $profile;
    /**
     * @var ProfileForm
     */
    private $profileform;

    function __construct(ProfileInterface $profile,ProfileForm $profileform)
    {
        $this->profile = $profile;
        $this->profileform = $profileform;
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($user)
	{

        $data['profile'] = $this->profile->byUser($user);
        $data['user'] = $user;
		return View::make('admin.profiles.index',$data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($user)
	{

        $data['user'] = $user;
		return View::make('admin.profiles.create',$data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($user)
	{
        $input = Input::only('full_name','content');
        $input['user_id'] = $user;
        //upload files
        $dataImg = array();
        if(Input::hasFile('file')){
            $dataImg = $this->profile->uploadImage(Input::file('file'));
        }
        if( $this->profileform->save( array_merge($input,$dataImg) ) )
        {
            // Success!
            return Redirect::to(route('admin.users.profiles.index',$user))
                ->with('status', 'success');
        } else {
            return Redirect::to(route('admin.users.profiles.create',$user))
                ->withInput()
                ->withErrors( $this->profileform->errors() )
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
        public function edit($user,$profile)
	{

        $profile = $this->profile->byId($profile);
        $data['profile'] = $profile;
        $data['user'] = $user;
        return View::make('admin.profiles.edit',$data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($user,$profile)
	{
        $input = Input::only('id','full_name','content');
        //upload files
        $dataImg = array();
        if(Input::hasFile('file')){
            $dataImg = $this->profile->uploadImage(Input::file('file'));
        }
        if( $this->profileform->update( array_merge($input,$dataImg) ) )
        {
            // Success!
            return Redirect::to(route('admin.users.profiles.index',$user,$profile))
                ->with('status', 'success');
        } else {
            return Redirect::to(route('admin.users.profiles.edit',array('user'=>$user,'profile'=>$profile)))
                ->withInput()
                ->withErrors( $this->profileform->errors() )
                ->with('status', 'error');
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($user,$profile)
	{
		//
        $this->profile->delete($profile);
        return Redirect::to(route('admin.users.profiles.index',$user));

    }

    public function postUpdateOrder(){
        $input = Input::all();
        $this->profile->updateOrder($input['profiles']);
    }


}