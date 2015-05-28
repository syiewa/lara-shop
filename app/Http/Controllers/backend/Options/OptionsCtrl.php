<?php

namespace App\Http\Controllers\backend\Options;

use App\Http\Controllers\Controller;
use App\Models\Options\Shipping;
use DB,
    Request,
    Entrust;

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
        return view('backend.options.index', $this->data);
    }

    public function getShipindex() {
        $this->data['shipping'] = Shipping::all();
        return view('backend.options.shipping.index', $this->data);
    }

    public function postShipstore() {
        $input = Request::except('_token');
        $input['enable_shipping'] = Request::get('enable_shipping') == 'on' ? '1' : 0;
        $input['shipping_method'] = implode(',', $input['shipping_method']);
        foreach ($input as $key => $val) {
            $ship = Shipping::where('ship_option_name', $key)->update(['ship_option_value' => $val]);
        }
        if ($ship) {
            return response()->json(['success' => TRUE]);
        }
    }

    public function getShipedit($id) {
        
    }

    public function putShipupdate() {
        
    }

}
