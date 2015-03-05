<?php

use App\Libraries\FrontendController;
use Qdesign\Repositories\Order\OrderInterface;
use Qdesign\Services\Form\Order\OrderForm;

class CartController extends FrontendController
{
    /**
     * @var Qdesign\Services\Form\Order\OrderForm
     */
    private $orderForm;
    /**
     * @var Qdesign\Repositories\Order\OrderInterface
     */
    private $order;

    function __construct(OrderInterface $order,OrderForm $orderForm)
    {
        parent::__construct();
        $this->orderForm = $orderForm;
        $this->order = $order;
    }

    public function getCart ( ){

        $this->data['cart'] = Cart::content();
        return View::make('cart.cart',$this->data);
    }

    public function postAdd ( $id ){

        $input = Input::all();
        if ( $id && is_numeric($id)) {
            //searching for product by id
            $product = DB::table('posts')
                ->select(array(
                    'id',
                    'name'
                ))
                ->where('id','=',$id)
                ->where('status','published')
                ->first();
            //check product
            if ($product) {
                $qty = $input['qty'];
                $material = $input['material'];
                    Cart::add(array(
                        'id' => substr(md5(rand()), 0, 7),
                        'name' => $product->name,
                        'qty' => $qty,
                        'price' => 0,
                        'options' => array(
                            'id' 	=> $product->id,
                            'material' => $material
                        ),
                    ));
                return Redirect::to(url('cart'));
            }
        }else{
            //error
            $errors = 'Sản phẩm không tồn tại';
            return Redirect::to(url('cart/error'))->withErrors($errors);
        }
    }

    public function postUpdate (){

        $input = Input::all();
        array_shift( $input);

        $input = (object)$input;
        foreach ($input as $key => $qty) {
            Cart::update( $key, $qty);
        }

        $msg = array(
            'status' 	=> 1,
            'message' 	=> 'Cập nhật đơn hàng thành công!'
        );

        return json_encode( $msg );

    }

    public function getRemove ( $id ){

        $msg = array();

        if ( $id ) {
            Cart::remove($id);
            $msg = array(
                'status' => 1,
                'message' => 'Remove item successfully',
            );

        }else{
            $msg = array('status' => 0,'message' => 'Error');
        }
        return json_encode($msg);
    }

    public function getMessage ( ){

        return View::make('cart.complete-message');
    }

    public function getCheckout ( ){

        $this->data['cart'] = Cart::content();
        return View::make('cart.checkout',$this->data);
    }

    public function postCheckout ( ){
        $input = Input::all();
        $input['date'] = date('ymd');
        $input['order_code'] = $input['date'] .'-'.uniqid();
        if( $order = $this->orderForm->save( $input ))
        {
            $cart = Cart::content();
            foreach ($cart as $item) {
                $d['order_id'] 	= $order->id;
                $d['cart_item_id'] 	= $item->id;
                $d['item_id'] 	= $item->options['id'];
                $d['product_name'] 	= $item->name;
                $d['material'] 	= $item->options['material'];
                $d['qty'] = $item->qty;
                DB::table('order_items')
                    ->insert($d);
            }
            $input['cart'] = $cart;
            Cart::destroy();
            try {
                Mail::send('emails.order', $input, function($message) use ($input)
                {
                    $message->from( 'vuongtrannguyenkhoi@gmail.com','Baby Shop');
                    $message->to(Auth::user()->email);
                    $message->subject('Thông tin đặt hàng từ Baby shop');
                });
            } catch (Exception $e) {

            }
            return Redirect::to(url('cart/checkout/message'));
        } else {
            return Redirect::to(url('cart/checkout'))
                ->withInput()
                ->withErrors( $this->orderForm->errors() )
                ->with('status', 'error');
        }
    }



}
