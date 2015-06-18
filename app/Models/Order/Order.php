<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    //
    protected $table = 'order';
    protected $fillable = ['order_id','payment_id', 'order_status', 'total_price', 'comments','shipping_type','shipping_to','shipping_fee'];

    public function orders() {
        return $this->belongsToMany('App\Models\Products\Product', 'order_product', 'order_id', 'product_id');
    }

}
