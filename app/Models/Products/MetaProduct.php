<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class MetaProduct extends Model {

    //
    protected $table = 'product_meta';
    protected $fillable = ['id_product', 'meta_title', 'meta_description', 'meta_keyword'];

    public function product() {
        return $this->belongsTo('App\Models\Products\Product', 'id_product');
    }

}
