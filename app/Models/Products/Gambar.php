<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use DB;

class Gambar extends Model {

    //
    protected $table = 'product_img';
    protected $fillable = ['id_product', 'img_name', 'path_thumb', 'path_full', 'primary'];

    public function product() {
        return $this->belongsTo('App\Models\Products\Product', 'id_product');
    }
}
