<?php

namespace App\Http\Controllers\backend\Options;

use App\Http\Controllers\Controller;
use App\Models\Options;
use App\Http\Requests\backend\Options\GeneralRequest;
use App\Http\Requests\backend\Options\ShopRequest;
use DB,
    Request,
    Entrust,
    Image;

class OptionsCtrl extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->data['title'] = 'Shop Options';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex() {
        //
//        if (!Entrust::can('page-read')) {
//            return redirect('');
//        }
        $this->data['sub_title'] = '';
        $this->data['city'] = Options\Shipping::where('ship_option_name', 'shipping_from')->first()->ship_option_value;
        return view('backend.options.index', $this->data);
    }

    public function getGeneralindex() {
        $this->data['general'] = Options\GeneralOption::all();
        return view('backend.options.general.index', $this->data);
    }

    public function postGeneralstore(GeneralRequest $request) {
        $input = $request->except('_token', 'store_logo');
        foreach ($input as $key => $val) {
            Options\GeneralOption::where('gen_store_name', $key)->update(['gen_store_val' => $val]);
        }
        $logo = public_path('images/store/');
        if ($request->hasFile('store_logo')) {
            $name = $request->file('store_logo')->getClientOriginalName();
            Options\GeneralOption::where('gen_store_name', 'store_logo')->update(['gen_store_val' => $name]);
            Image::make($request->file('store_logo'))->resize('139', '39')->save($logo . '/' . $name);
        }
        return response()->json(['success' => TRUE]);
    }

    public function getShipindex() {
        $this->data['shipping'] = Options\Shipping::all();
        return view('backend.options.shipping.index', $this->data);
    }

    public function postShipstore() {
        $input = Request::except('_token');
        $input['enable_shipping'] = Request::get('enable_shipping') == 'on' ? '1' : 0;
        $input['shipping_method'] = implode(',', $input['shipping_method']);
        foreach ($input as $key => $val) {
            $ship = Options\Shipping::where('ship_option_name', $key)->update(['ship_option_value' => $val]);
        }
        if ($ship) {
            return response()->json(['success' => TRUE]);
        }
    }

    public function getShopindex() {
        $this->data['shop'] = Options\ShopOption::all();
        return view('backend.options.shop.index', $this->data);
    }

    public function postShopstore(ShopRequest $request) {
        $input = $request->except('_token');
        foreach ($input as $key => $val) {
            $shop = Options\ShopOption::where('shop_opt_name', $key)->update(['shop_opt_value' => $val]);
        }
        if ($shop) {
            return response()->json(['success' => TRUE]);
        }
    }

    public function getMailindex() {
        $this->data['mail'] = Options\MailOption::lists('mail_value', 'mail_key');
        return view('backend.options.mail.index', $this->data);
    }

    public function postMailstore() {
        $input = Request::except('_token');
        foreach ($input as $key => $val) {
            $ship = Options\MailOption::where('mail_key', $key)->update(['mail_value' => $val]);
        }
        if ($ship) {
            return response()->json(['success' => TRUE]);
        }
    }

    public function getSocialindex() {
        $this->data['social'] = Options\SocialOption::lists('social_value', 'social_key');
        return view('backend.options.social.index', $this->data);
    }

    public function postSocialstore() {
        $input = Request::except('_token');
        foreach ($input as $key => $val) {
            $ship = Options\SocialOption::where('social_key', $key)->update(['social_value' => $val]);
        }
        if ($ship) {
            return response()->json(['success' => TRUE]);
        }
    }
    
    public function getPaymentindex(){
        $this->data['payments'] = Options\Payments::all();
        return view('backend.options.payment.index',$this->data);
    }
    
    public function getEditpayment($id){
        $this->data['title'] = 'Payment';
        $this->data['sub_title'] = 'Edit Payment';
        $this->data['payment'] = Options\Payments::find($id);
        return view('backend.options.payment.edit',$this->data);
    }
    
    public function putPaymentupdate($id){
        $input = Request::only('payment_description','payment_status');
        $input['payment_status'] = Request::get('payment_status') == 'on' ? 1 : 0;
        $payment = Options\Payments::find($id);
        if($payment->update($input)){
            return redirect()->to('backend/options');
        }
    }

}
