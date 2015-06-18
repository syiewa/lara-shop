<?php

namespace App\Http\Controllers\Front;

use Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Order\Order;
use App\Models\Page;
use App\Models\Widget;
use App\Models\Users\User;
use Illuminate\Support\Str;
use App\Http\Requests\ShippingRequest;
use Session,
    Auth;
use Veritrans_VtWeb;
use Veritrans_Transaction;
use Exception;

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
        return view('front.eshopper.pages.postRegister', $this->data);
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
            $this->data['related_product'] = Products\Product::where('id_category', $findpro->id_category)->where('id', '!=', $findpro->id)->get();
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
        $order['user'] = $request->except('_token', 'payment_id');
        Session::put(['order' => $order]);
        if ($user->update($input)) {
            return response()->json(['success' => TRUE]);
        }
    }

    public function getReviewPayment() {
        $this->data['order'] = Session::get('order');
        $this->data['pay'] = $this->renderPaymentLink($this->data['order']);
        return view('front.eshopper.pages.review-payment', $this->data);
    }

    public function postOrder() {
        $orders = Session::get('order');
        $order = new Order();
        $order->user_id = $orders['user']['user_id'];
        $order->order_id = Order::max()+1;
        $order->total_price = $orders['total'];
        $order->shipping_type = $orders['shipping']['service'];
        $order->shipping_to = $orders['shipping']['city'];
        $order->shipping_fee = $orders['shipping']['fee'];
        $order->save();
        foreach ($orders['product'] as $product) {
            $order->orders()->attach($product['id'], ['quantity' => $product['product_qty']]);
        }
        return response()->json(['success' => TRUE]);
    }

    public function getAccount() {
        if (!Auth::check()) {
            return redirect('customer/login');
        }
        return view('front.eshopper.pages.account', $this->data);
    }

    public function getPaymentDescription($id) {
        $payment = \App\Models\Options\Payments::find($id);
        if ($payment) {
            return $payment->payment_description;
        }
    }

    public function getOrderComplete() {
        try {
            $status = Veritrans_Transaction::status(Request::get('order_id'));
            $order = Order::where('order_id', $status->order_id)->first();
            $order->payment_id = \App\Models\Options\Payments::where('payment_type', $status->payment_type)->first()->id;
            $order->order_status = $status->transaction_status;
            $order->save();
        } catch (Exception $exc) {
            Session::flash('error', $exc->getMessage());
        }
        if (!Session::has('error')) {
            Session::forget('order');
        }
        return view('front.eshopper.pages.checkout-success', $this->data);
    }

    private function renderPaymentLink($array = []) {

        $order = $array;
        $transaction_details = array(
            'order_id' => Order::max('order_id') + 1,
            'gross_amount' => $order['total'], // no decimal allowed for creditcard
        );
        $i = 0;
        foreach ($order['product'] as $product) {
            $items_details = [
                $i => [
                    'id' => $product['id'],
                    'price' => $product['product_price'],
                    'quantity' => $product['product_qty'],
                    'name' => $product['product_name']
                ]
            ];
            $i++;
        }
        $shipping_fee = [
            'id' => 'shipping',
            'price' => $order['shipping']['fee'],
            'quantity' => '1',
            'name' => $order['shipping']['service']
        ];
        array_push($items_details, $shipping_fee);
// Optional
        $billing_address = array(
            'first_name' => $order['user']['first_name'],
            'last_name' => $order['user']['last_name'],
            'address' => $order['user']['address'],
            'city' => getCity($order['user']['city']),
            'postal_code' => "55281",
            'phone' => $order['user']['mob_phone'],
            'country_code' => 'IDN'
        );

// Optional
        $customer_details = array(
            'first_name' => $order['user']['first_name'],
            'last_name' => $order['user']['last_name'],
            'email' => $order['user']['email'],
            'phone' => $order['user']['mob_phone'],
            'billing_address' => $billing_address,
            'shipping_address' => $billing_address
        );

// Fill transaction details
        $transaction = array(
            'payment_type' => 'vtweb',
            "vtweb" => array(
                "enabled_payments" => getPayment(),
                "credit_card_3d_secure" => true,
                //Set Redirection URL Manually
                "finish_redirect_url" => url('checkout/complete'),
                "unfinish_redirect_url" => url('checkout/uncomplete'),
                "error_redirect_url" => url('checkout/error'),
            ),
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $items_details,
        );
        $vtweb_url = Veritrans_VtWeb::getRedirectionUrl($transaction);
        return $vtweb_url;
    }

}
