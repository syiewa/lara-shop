<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model {

    //
    protected $table = 'product_category';
    protected $fillable = ['name', 'parent', 'order', 'slug', 'status','image'];

    public function product() {
        return $this->hasMany('App\Models\Products\Product','id_category');
    }

    public function children() {
        return $this->hasMany('App\Models\Products\Category', 'parent', 'id');
    }

    public function scopeGetNested($query) {
        $pages = $query->with('children')->orderBy('order')->get()->toArray();
        $i = 0;
        $array = array();
        if ($pages) {
            foreach ($pages as $page) {
                if ($page['parent'] == 0) {
                    $array[$page['id']] = $page;
                }
                $i++;
            }
        }
        return $array;
    }

}
