<?php namespace Qdesign\Repositories\Order;

use Qdesign\Repositories\RepositoryAbstract;
use Illuminate\Database\Eloquent\Model;
class EloquentOrder extends RepositoryAbstract implements OrderInterface {

    protected $modelInstance;
    // Class expects an Eloquent model
    public function __construct(Model $order)
    {
        $this->model = $order;
    }

    public function all(){
        return $this->model
                    ->orderBy('date','desc')
                    ->orderBy('customer_name','asc')
                    ->get();
    }

    public function byId($id)
    {
        return $this->find($id);
    }

    public function create(array $data)
    {
        $order = $this->model->create($data);

        if( ! $order )
        {
            return false;
        }

        return $order;
    }

    public function update(array $data)
    {
        $order = $this->find($data['id']);
        $fields = array(
            'customer_name',
            'phone',
            'address',
            'email',
            'note',
        );
        $order->myUpdate($fields,$data);
        $order->save();
        return true;
    }

    public function delete($id)
    {
        $order = $this->find($id);
        $order->delete();
        return true;
    }

    private function find($id){
        if(is_null($this->modelInstance))
            $this->modelInstance = $this->model->find($id);
        if(is_null($this->modelInstance))throw new OrderNotFoundException('the order with id='.$this->id.' not found');
        return $this->modelInstance;
    }

}
