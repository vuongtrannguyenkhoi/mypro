<?php namespace Qdesign\Models;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: bluesky
 * Date: 5/4/14
 * Time: 5:01 PM
 */

class Order extends AbstractModel{

    public function getOrderItems()
    {
        $items = DB::table('order_items')
                    ->whereOrderId($this->id)
                    ->orderBy('product_name')
                    ->get();
        return $items;
    }

    public function Customer()
    {
        return $this->belongsTo('Qdesign\Models\User','created_by');
    }
}