<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    //
    protected $table = 'pages';
    protected $fillable = ['page_name', 'page_slug', 'page_type', 'page_status', 'page_position', 'page_order', 'page_parent', 'page_content'];

    public function getPageContentAttribute($value) {
        return str_replace(["\r\n", "\n", "\r"],'&nbsp;',$value);
        
    }

    public function children() {
        return $this->hasMany('App\Models\Page\Page', 'page_parent', 'id');
    }

    public function scopeGetNested($query, $position) {
        $pages = $query->with('children')->where('page_position', $position)->orderBy('page_order')->get()->toArray();
        $i = 0;
        $array = array();
        if ($pages) {
            foreach ($pages as $page) {
                if ($page['page_parent'] == 0) {
                    $array[$page['id']] = $page;
                }
                $i++;
            }
        }
        return $array;
    }

}
