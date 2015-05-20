<?php

namespace App\Http\Controllers\Front;

use Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Page;
use App\Models\Widget;
use Illuminate\Support\Str;
use Session;

class PageCtrl extends Controller {

    public function __construct() {
        $this->data['categories'] = Products\Category::where('status', '!=', 0)->GetNested();
        $this->data['products'] = Products\Product::where('status', '!=', 0)->take(3)->get();
        $this->data['mtop'] = Page\Page::where('page_status', 1)->where('page_position', '=', 'top')->GetNested('top');
        $this->data['mbottom'] = Page\Page::where('page_status', 1)->where('page_position', '=', 'bottom')->GetNested('bottom');
        $this->data['slideshow'] = Widget\Slideshow::where('ss_status', 1)->orderBy('ss_order')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
        return view('front.eshopper.pages.home', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug) {
        //
        $findcat = Products\Category::with('product')->where('slug', $slug)->first();
        if (count($findcat) == 0) {
            $findpro = Products\Product::where('slug', $slug)->first();
            $this->data['product'] = $findpro;
            if (count($findpro) > 0) {
                return view('front.eshopper.pages.product', $this->data);
            }
        } else {
            $this->data['products'] = $findcat->product()->paginate(5);
            return view('front.eshopper.pages.category', $this->data);
        }
        $this->data['page'] = Page\Page::where('page_slug', $slug)->first();
        if (count($this->data['page'])) {
            return view('front.eshopper.pages.pages', $this->data);
        }
        return abort('404','Page Not Found');
    }

    public function checkout() {
//        dd(Request::all());
        return view('front.eshopper.pages.cart', $this->data);
    }

    public function postcheckout() {
        $user = TRUE;
        if (Request::get('itemCount') == 0) {
            return redirect()->back();
        }
        if ($user) {
            return $this->payment(Request::all());
        }
        $this->data['cart'] = Request::all();
        return view('front.eshopper.pages.checkout', $this->data);
    }

    public function payment($data = '') {
        $this->data['order'] = $this->setOrder($data);
        return view('front.eshopper.pages.payment', $this->data);
    }

    private function setOrder($data) {
        $order = [];
        $total = 0;
        for ($i = 1; $i <= $data['itemCount']; $i++) {
            $order['shipping'] = $data['shipping'];
            $product_id = explode(',', str_replace(' ', '', $data['item_options_' . $i]));
            $pro_id = preg_replace("/[^0-9,.]/", "", $product_id[0]);
            unset($product_id[0]);
            $options = implode(',', $product_id);
            $order['product'][] = [
                'id' => $pro_id,
                'product_img' => Products\Product::find($pro_id)->image->first() ? Products\Product::find($pro_id)->image->first()->path_thumb : '',
                'product_name' => $data['item_name_' . $i],
                'product_qty' => $data['item_quantity_' . $i],
                'product_price' => $data['item_price_' . $i],
                'product_options' => $options,
                'product_tprice' => $data['item_quantity_' . $i] * $data['item_price_' . $i]
            ];
            $total += $data['item_quantity_' . $i] * $data['item_price_' . $i];
            $order['sub_total'] = $total;
        }
        $order['total'] = $order['sub_total'] + $order['shipping'];
        return $order;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
