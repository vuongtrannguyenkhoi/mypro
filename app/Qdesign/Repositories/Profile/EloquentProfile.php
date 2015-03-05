<?php namespace Qdesign\Repositories\Profile;

use Intervention\Image\Image;
use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentProfile extends RepositoryAbstract implements ProfileInterface {
    public static $path = 'upload/images/layout/';
    // Class expects an Eloquent model
    protected $profileInstance;

    public function __construct(Model $profile)
    {
        $this->model = $profile;
    }

    public function all(){
        $results = array();
        $profiles = $this->model->all();

        foreach ($profiles as $profile) {
            $o = new EloquentProfile($this->model);
            $o->id = $profile->id;
            $o->full_name = $profile->full_name;
            $o->photo = $profile->photo;
            $o->created_at = $profile->created_at;
            $o->updated_at = $profile->updated_at;
            $o->created_by = $profile->created_by;
            $o->updated_by = $profile->updated_by;
            $results[] = $o;
        }
        return $results;
    }

    public function byId($id)
    {
        $profile = $this->find($id);
        $o = new EloquentProfile($this->model);
        $o->id = $profile->id;
        $o->full_name = $profile->full_name;
        $o->photo = $profile->photo;
        $o->content = $profile->content;
        $o->created_at = $profile->created_at;
        $o->updated_at = $profile->updated_at;
        $o->created_by = $profile->created_by;
        $o->updated_by = $profile->updated_by;
        return $o;
    }

    public function byUser($user)
    {
        $profile = $this->model->where('user_id','=',$user)->first();
        if(!$profile) return $profile;
        $o = new EloquentProfile($this->model);
        $o->id = $profile->id;
        $o->full_name = $profile->full_name;
        $o->content = $profile->content;
        $o->photo = $profile->photo;
        $o->created_at = $profile->created_at;
        $o->updated_at = $profile->updated_at;
        $o->created_by = $profile->created_by;
        $o->updated_by = $profile->updated_by;
        return $o;
    }


    public function byPage($page=1, $limit=10, $all=false)
    {
        $result = new EloquentProfile($this->model);
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->model->orderBy('created_at', 'desc');

        if( ! $all )
        {
            $query->where('status_id', 1);
        }

        $profiles = $query->skip( $limit * ($page-1) )
            ->take($limit)
            ->get();

        $result->totalItems = $this->totalProfiles($all);
        $result->items = $profiles->all();

        return $result;
    }

    public function create(array $data)
    {
        $profile = $this->model->create($data);

        if( ! $profile )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $issue = $this->find($data['id']);
        $fields = array('full_name','photo','content');
        $issue->myUpdate($fields,$data);
        $issue->save();
        return true;
    }

    protected function totalProfiles($all = false)
    {
        if( ! $all )
        {
            return $this->model->where('status_id', 1)->count();
        }

        return $this->model->count();
    }

    public function delete($id)
    {
        $profile = $this->find($id);
        $profile->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->profileInstance))
            $this->profileInstance = $this->model->find($id);
        if(is_null($this->profileInstance))throw new ProfileNotFoundException('the profile with id='.$id.' not found in database');
        return $this->profileInstance;
    }
    public function uploadImage($file){
        $extension = $file->getClientOriginalExtension();
        $filename = sha1(time().time()).".{$extension}";

        $destinationPath = self::$path;

        //upload
        Image::make($file->getRealPath())->save($destinationPath.$filename);
        //resize
        $filename_x_x = 'thumb_'.$filename;

        Image::make( $destinationPath.$filename )->resize(30,null,function($constraint){
            $constraint->aspectRatio();
        })->save( $destinationPath.$filename_x_x );
        $data['photo'] = self::$path.$filename;
        $data['thumb'] = self::$path.$filename_x_x;
        return $data;
    }

}
