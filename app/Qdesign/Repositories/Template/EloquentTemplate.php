<?php namespace Qdesign\Repositories\Template;

use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentTemplate extends RepositoryAbstract implements TemplateInterface {

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $template)
    {
        $this->model = $template;
    }

    public function all(){
        return $this->model->all();
    }

    public function byId($id)
    {
        return $this->find($id);
    }


    public function create(array $data)
    {
        $template = $this->model->create($data);

        if( ! $template )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $template = $this->find($data['id']);
        $fields = array(
            'template',
            'name',
            'description',
        );
        $template->myUpdate($fields,$data);
        $template->save();
        return true;
    }

    public function delete($id)
    {
        $template = $this->find($id);
        $template->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new TemplateNotFoundException('the template with id='.$this->id.' not found');
        return $this->modelInstance;
    }

}
