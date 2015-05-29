<?php

namespace App\Http\Requests\backend\Options;

use App\Http\Requests\Request;

class GeneralRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
            'store_url' => 'required|url',
            'store_name' => 'required',
            'store_owner' => 'required',
            'store_address' => 'required',
            'store_email' => 'required|email',
            'store_phone' => 'required',
            'store_logo' => 'image'
        ];
    }

}
