<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function SetAttr($array = []) {
    $html = '';
    $html .= '<span>';
    foreach ($array as $attr) {
        $html .= '<label>' . ucwords($attr->name) . '</label>';
        $html .= '<select class="item_' . $attr->name . '" name="' . $attr->name . '">';
        $values = explode(',', $attr->values);
        foreach ($values as $val) {
            $html .= '<option value=' . $val . '>' . $val . '</option>';
        }
        $html .= '</select>';
    }
    $html .='</span>';
    return $html;
}

function shipOption($key = '') {
    $data = App\Models\Options\Shipping::where('ship_option_name', $key)->first();
    if ($key == 'shipping_method') {
        $method = explode(',', $data->ship_option_value);
        return $method;
    }
    return $data->ship_option_value;
}

function genOpt($key = '') {
    $data = App\Models\Options\GeneralOption::where('gen_store_name', $key)->first();
    if ($data) {
        return $data->gen_store_val;
    }
}

function shopOpt($key = '') {
    $data = App\Models\Options\ShopOption::where('shop_opt_name', $key)->first();
    if ($data) {
        return $data->shop_opt_value;
    }
}

function socialUrl($key = '') {
    $data = App\Models\Options\SocialOption::where('social_key', $key)->first();
    if ($data) {
        return $data->social_value;
    }
}

function socialOpt() {
    return App\Models\Options\SocialOption::all();
}

function getPayment() {
    $payments = \App\Models\Options\Payments::where('payment_status', '1')->get();
    foreach($payments as $payment){
        $data[] = $payment->payment_type; 
    }
    return $data;
}

function getCity($id = '') {
    $request = Request::create('api/ongkir/city/'.$id, 'GET');
    return Route::dispatch($request)->getContent();
}
