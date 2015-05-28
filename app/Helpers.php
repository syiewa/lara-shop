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
        $method = explode(',',$data->ship_option_value);
        return $method;
    }
    return $data->ship_option_value;
}
