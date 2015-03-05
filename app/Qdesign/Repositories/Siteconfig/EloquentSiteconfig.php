<?php namespace Qdesign\Repositories\Siteconfig;

use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
use DB;
class EloquentSiteconfig extends RepositoryAbstract implements SiteconfigInterface {

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $siteconfig)
    {
        $this->model = $siteconfig;
    }

    public function all(){

    }

    public function byId($id)
    {
        $siteconfig = $this->find($id);
        $o = new EloquentSiteconfig($this->model);
        $o->id = $siteconfig->id;
        $o->name = $siteconfig->name;
        $o->slug = $siteconfig->slug;
        $o->content = $siteconfig->content;
        return $o;
    }
    public function first(){
        return $this->model->all()->first();
    }
    public function create(array $data)
    {
        $siteconfig = $this->model->create($data);

        if( ! $siteconfig )
        {
            return false;
        }

        return true;
    }

    public function update(array $data)
    {
        $siteconfig = $this->first();
        $fields = array('site_title',
            'site_meta_description',
            'site_meta_keywords',
            'site_name',
            'pagination_perpage',
            'company_name',
            'company_address',
            'company_phone',
            'company_website',
            'company_receive_email');
        $siteconfig->myUpdate($fields,$data);
        $siteconfig->save();
        return true;
    }

    public function delete($id)
    {
        $siteconfig = $this->find($id);
        $siteconfig->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new SiteconfigNotFoundException('the siteconfig with id='.$this->id.' not found');
        return $this->modelInstance;
    }

}
