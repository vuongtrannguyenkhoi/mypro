<?php namespace Qdesign\Repositories\User;

use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentUser extends RepositoryAbstract implements UserInterface {

    protected $user;
    protected $userInstance;
    const ROLE_CLIENT = 3;
    const ROLE_SALE = 2;
    const ROLE_SUPERUSER = 1;
    // Class expects an Eloquent model
    public function __construct(Model $user)
    {
        $this->user = $user;
    }


    public function all()
    {
        return $this->user->all();
    }
    public function byId($id)
    {
        return $this->user->with('profile')->find($id);
    }

    public function byPage($page=1, $limit=10, $all=false)
    {
        $result = new EloquentUser($this->user);
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->user->orderBy('created_at', 'desc');

        if( ! $all )
        {
            $query->where('status_id', 1);
        }

        $users = $query->skip( $limit * ($page-1) )
            ->take($limit)
            ->get();

        $result->totalItems = $this->totalUsers($all);
        $result->items = $users->all();

        return $result;
    }

    public function createdBy($user, $page=1, $limit=10){
        $result = new EloquentUser($this->user);
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();
        $query = $this->user->where('created_by','=',$user);

        $query = $query->orderBy('created_at', 'desc');
        $layouts = $query->skip( $limit * ($page-1) )
            ->take($limit)
            ->get();

        $result->totalItems = $this->totalUsersCreatedBy($user);
        $result->items = $layouts->all();

        return $result;
    }

    public function create(array $data)
    {
        // Create the article
        $user = $this->user->create($data);

        if( ! $user )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $user = $this->find($data['id']);
        $fields = array(
            'role',
            'status',
            'email',
        );
        if($data['password'])
            $fields[] = 'password';
        $user->myUpdate($fields,$data);
        $user->save();
        return true;
    }



    protected function totalUsers($all = false)
    {
        if( ! $all )
        {
            return $this->user->where('status_id', 1)->count();
        }

        return $this->user->count();
    }

    protected  function totalUsersCreatedBy($user){
        return $this->user->where('created_by','=',$user)->count();
    }

    public function delete($id)
    {
        $user = $this->find($id);
        $user->delete();
        return true;
    }

    public function profile()
    {
        return $this->find($this->id)->profile;
    }

    public function find( $id ){
        if(is_null($this->userInstance))
            $this->userInstance = $this->user->find($id);
        if(is_null($this->userInstance))throw new UserNotFoundException('the User with id='.$this->id.' not found');
        return $this->userInstance;
    }
}
