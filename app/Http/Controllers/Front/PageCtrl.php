<?php

namespace App\Http\Controllers\Front;

use Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Page;
use App\Models\Widget;
use App\Models\Users\User;
use Illuminate\Support\Str;
use App\Http\Requests\ShippingRequest;
use Session,
    Auth;

class PageCtrl extends Controller {

    public function __construct() {
        parent::__construct();
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

    public function registerSuccess() {
        return view('front.eshopper.pages.postRegister',$this->data);
    }

    public function activateAccount($code, User $user) {
        if ($user->accountIsActive($code)) {
            return view('front.eshopper.pages.activated', $this->data);
        }
    }

    public function show($slug) {
        //
        $findcat = Products\Category::with('product')->where('slug', $slug)->first();
        if (count($findcat) == 0) {
            $findpro = Products\Product::where('slug', $slug)->first();
            
            $this->data['product'] = $findpro;
            $this->data['related_product'] = Products\Product::where('id_category',$findpro->id_category)->where('id','!=',$findpro->id)->get();
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
        return abort('404', 'Page Not Found');
    }

    public function checkout() {
//        dd(Request::all());
        $this->data['ship_method'] = shipOption('shipping_method');
        return view('front.eshopper.pages.cart', $this->data);
    }

    public function postcheckout() {
        if (Request::method() == 'POST') {
            if (Request::get('itemCount') == 0) {
                return redirect()->back()->withErrors(['message' => 'Keranjang Belanja Kosong']);
            }
            if (Auth::check()) {
                return redirect()->to('checkout/shipping')->with(['data' => Request::all()]);
            }
        }
        return view('front.eshopper.pages.checkout', $this->data);
    }

    public function shipping() {
        $data = Session::get('data');
        if (empty($data)) {
            if (Session::has('order')) {
                $this->data['order'] = Session::get('order');
            } else {
                return redirect('checkout');
            }
        } else {
            $this->data['order'] = $this->setOrder($data);
            Session::put(['order' => $this->setOrder($data)]);
        }
        $this->data['user'] = Auth::user();
        return view('front.eshopper.pages.shipping', $this->data);
    }

    private function setOrder($data) {
        $order = [];
        $total = 0;
        for ($i = 1; $i <= $data['itemCount']; $i++) {
            $order['shipping'] = [
                'service' => isset($data['service']) ? $data['service'] : '',
                'city' => isset($data['city']) ? $data['city'] : Auth::user()->city,
                'province' => isset($data['province']) ? $data['city'] : Auth::user()->province,
                'fee' => $data['shipping']
            ];
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
        $order['total'] = $order['sub_total'] + $order['shipping']['fee'];
        return $order;
    }

    public function postShipping(ShippingRequest $request) {
        $input = $request->all();
        $user = User::find($input['user_id']);
        $order = Session::get('order');
        $order['user'] = $request->except('_token','payment_id');
        $order['payment_id'] = $input['payment_id'];
        Session::put(['order' => $order]);
        if ($user->update($input)) {

            return response()->json(['success' => TRUE]);
        }
    }

    public function getAccount() {
        if (!Auth::check()) {
            return redirect('customer/login');
        }
        return view('front.eshopper.pages.account', $this->data);
    }
    
    public function getPaymentDescription($id){
        $payment = \App\Models\Options\Payments::find($id);
        if($payment){
            return $payment->payment_description;
        }
    }
    
    public function getOrderComplete(){
        return 'Thanks For Order';
    }

}
