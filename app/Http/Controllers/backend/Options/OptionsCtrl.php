<?php

namespace App\Http\Controllers\backend\Options;

use App\Http\Controllers\Controller;
use App\Models\Options\Shipping;
use App\Models\Options\GeneralOption;
use App\Http\Requests\backend\Options\GeneralRequest;
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
        return view('backend.options.index', $this->data);
    }

    public function getGeneralindex() {
        $this->data['general'] = GeneralOption::all();
        return view('backend.options.general.index', $this->data);
    }

    public function postGeneralstore(GeneralRequest $request) {
        $input = $request->except('_token', 'store_logo');
        foreach ($input as $key => $val) {
            GeneralOption::where('gen_store_name', $key)->update(['gen_store_val' => $val]);
        }
        $logo = public_path('images/store/');
        if ($request->hasFile('store_logo')) {
            $name = $request->file('store_logo')->getClientOriginalName();
            GeneralOption::where('gen_store_name', 'store_logo')->update(['gen_store_val' => $name]);
            Image::make($request->file('store_logo'))->save($logo . '/' . $name);
        }
        return response()->json(['success' => TRUE]);
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
