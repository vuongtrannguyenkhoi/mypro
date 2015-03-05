<?php namespace Admin;
use Datatable;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Qdesign\Repositories\User\UserInterface;
use Qdesign\Services\Form\User\UserForm;
use App\Libraries\BackendController;
class UsersController extends BackendController {

    /**
     * @var Qdesign\Repositories\User\UserInterface
     */
    private $user;
    /**
     * @var UserForm
     */
    private $userform;

    function __construct(UserInterface $user,UserForm $userform)
    {
        $this->user = $user;
        $this->userform = $userform;
        $this->data['roles'] = array(
            '1'=>'Admin',
            '2'=>'Sale',
            '3'=>'Client',
            '4'=>'Guest'
        );
        $this->data['statuses'] = array(
            '1' => 'Active',
            '2' => 'Wait to active',
            '3' => 'Suspended',
        );
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


		return View::make('admin.users.index', $this->data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.users.create',$this->data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only(
            'username',
            'email',
            'password',
            'password_confirmation',
            'role',
            'status'
        );
        if( $this->userform->save( $input ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#users')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#users/create')
                ->withInput()
                ->withErrors( $this->userform->errors() )
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

        $this->data['user'] = $this->user->byId($id);
        return View::make('admin.users.edit', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        if( $this->userform->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#users')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#users/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->userform->errors() )
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
        $this->user->delete($id);
        return Redirect::to('admin/dashboard#users');

    }

    public function getDatatable()
    {
        $roles = $this->data['roles'];
        $statuses = $this->data['statuses'];
        return Datatable::collection($this->user->all())
            ->addColumn('username',function($model)
                {
                    return "<strong><a href='#users/{$model->id}/edit'>{$model->username}</a><strong/>";
                }
            )
            ->addColumn('role',function($model) use($roles)
                {
                    return $roles[$model->role];
                }
            )
            ->addColumn('status',function($model) use($statuses)
                {
                    return $statuses[$model->status];
                }
            )

            ->addColumn('delete',function($model)
                {
                    return '<form method="POST" action="'.url('admin/users/'.$model->id).'" accept-charset="UTF-8" class="pull-right">
                    <input name="_method" type="hidden" value="DELETE">
                    <input class="btn btn-primary btn-xs" type="submit" value="delete">
                    </form>';
                }
            )
            ->searchColumns(
                'username'
            )
            ->orderColumns('username','desc')
            ->make();
    }

}