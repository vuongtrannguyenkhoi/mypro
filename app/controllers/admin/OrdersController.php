<?php namespace Admin;

use Input;
use View;
use Redirect;
use Qdesign\Repositories\Order\OrderInterface;
use Qdesign\Services\Form\Order\OrderForm;
use App\Libraries\BackendController;
class OrdersController extends BackendController{


    /**
     * @var \Qdesign\Repositories\Order\OrderInterface
     */
    private $order;
    /**
     * @var \Qdesign\Services\Form\Order\OrderForm
     */
    private $orderForm;

    function __construct(OrderInterface $order,OrderForm $orderForm)
    {

        $this->order = $order;
        $this->orderForm = $orderForm;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $data['orders'] = $this->order->all();
        return View::make('admin.orders.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if( $this->orderForm->save( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#orders')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#create')
                ->withInput()
                ->withErrors( $this->orderForm->errors() )
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
        $this->data['order'] = $this->order->byId($id);
        return View::make('admin.orders.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $order = $this->order->byId($id);
        return View::make('admin.orders.edit',array('order'=>$order));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
        if( $this->orderForm->update( Input::all() ) )
        {
            // Success!
            return Redirect::to('admin/dashboard#orders')
                ->with('status', 'success');
        } else {
            return Redirect::to('admin/dashboard#order/'.$id.'/edit')
                ->withInput()
                ->withErrors( $this->orderForm->errors() )
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
        $this->order->delete($id);
        return Redirect::to('admin/dashboard#orders');

    }

    public function getDatatable()
    {
        return \Datatable::collection($this->order->all())
            ->addColumn('order_code',function($model)
                {
                    return "<a href='#orders/{$model->id}' title='Click to see more detail'>{$model->order_code}</a>";
                }
            )
            ->addColumn('customer_name',function($model)
                {
                    return $model->customer_name;
                }
            )
            ->addColumn('phone',function($model)
                {
                    return $model->phone;
                }
            )
            ->addColumn('email',function($model)
                {
                    return $model->email;
                }
            )
            ->addColumn('address',function($model)
                {
                    return $model->address;
                }
            )
            ->addColumn('date',function($model)
                {
                    return $model->date;
                }
            )
            ->addColumn('edit',function($model)
                {
                    return "<a href='#orders/{$model->id}/edit'>edit</a>";
                }
            )
            ->addColumn('delete',function($model)
                {
                    return '<form method="POST" action="'.url('admin/orders/'.$model->id).'" accept-charset="UTF-8" class="pull-right">
                    <input name="_method" type="hidden" value="DELETE">
                    <input class="btn btn-warning btn-xs" type="submit" value="delete">
                    </form>';
                }
            )
            ->searchColumns(
            	'date',
                'order_code',
                'customer_name',
                'phone'

            )
            ->orderColumns('date','asc')
            ->make();
    }
}