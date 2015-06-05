<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Products;
use App\Models\Page;
use App\Models\Widget;
use App\Models\Users\User;

abstract class Controller extends BaseController {

    use DispatchesCommands,
        ValidatesRequests;

    public function __construct() {
        $this->data['categories'] = Products\Category::where('status', '!=', 0)->GetNested();
        $this->data['products'] = Products\Product::where('product_status', '!=', 0)->take(shopOpt('product_perpage_front'))->get();
        $this->data['mtop'] = Page\Page::where('page_status', 1)->where('page_position', '=', 'top')->GetNested('top');
        $this->data['mbottom'] = Page\Page::where('page_status', 1)->where('page_position', '=', 'bottom')->GetNested('bottom');
        $this->data['slideshow'] = Widget\Slideshow::where('ss_status', 1)->orderBy('ss_order')->get();
    }

}
