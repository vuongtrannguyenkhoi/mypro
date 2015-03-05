<?php namespace Qdesign\Repositories\Controller;

use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentController extends RepositoryAbstract implements ControllerInterface {

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $controller)
    {
        $this->model = $controller;
    }

    public function all(){
        return $this->model->all();
    }

    public function byId($id)
    {
        return $this->find($id);
    }

    public function byController($controller)
    {
        return $this->model->whereController($controller)->first();
    }

    public function create(array $data)
    {
        $controller = $this->model->create($data);

        if( ! $controller )
        {
            return false;
        }
        //insert templates
        if(isset($data['templates']))
            $controller->templates()->sync($data['templates']);

        return true;
    }

    public function update(array $data)
    {
        $controller = $this->find($data['id']);
        $fields = array(
            'controller',
            'name',
            'description',
        );
        $controller->myUpdate($fields,$data);
        $controller->save();
        if(isset($data['templates']))
            $controller->templates()->sync($data['templates']);
        return true;
    }

    public function delete($id)
    {
        $controller = $this->find($id);
        $controller->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new ControllerNotFoundException('the controller with id='.$this->id.' not found');
        return $this->modelInstance;
    }

}
