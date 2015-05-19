<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    //
    protected $table = 'product_attr';
    protected $fillable = ['name', 'values'];

    public function product() {
        return $this->belongsTo('App\Models\Products\Product', 'id_product');
    }

    public function scopeSaveAttribute($query,$id, $name, $value) {
        $date = new \DateTime;
        $data = [];
        foreach ($name as $k => $v) {
            foreach ($value as $key => $val) {
                if ($k == $key) {
                    $data[] = [
                        'id_product' => $id,
                        'name' => $v,
                        'values' => $val,
                        'created_at' => $date,
                        'updated_at' => $date
                    ];
                }
            }
        }
        $query->insert($data);
    }

}
