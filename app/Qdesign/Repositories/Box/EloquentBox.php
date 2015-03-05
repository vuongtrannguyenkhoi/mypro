<?php namespace Qdesign\Repositories\Box;

use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentBox extends RepositoryAbstract implements BoxInterface {

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $box)
    {
        $this->model = $box;
    }

    public function all(){
        return $this->model->all();
    }

    public function byId($id)
    {
        return $this->find($id);
    }

    public function bySlug($slug){
        return $this->model->whereSlug($slug)
            ->first();
    }

    public function create(array $data)
    {
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $box = $this->model->create($data);

        if( ! $box )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $box = $this->find($data['id']);
        $fields = array(
            'name',
            'slug',
            'content',
        );
        $data['slug'] = $this->slug($data['slug']);
        $data['content'] = stripslashes($data['content']) ;
        $box->myUpdate($fields,$data);
        $box->save();
        return true;
    }

    public function delete($id)
    {
        $box = $this->find($id);
        $box->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new BoxNotFoundException('the box with id='.$this->id.' not found');
        return $this->modelInstance;
    }

}
