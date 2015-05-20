<?php

namespace App\Http\Requests\backend\User;

use App\Http\Requests\Request;

class RoleRequest extends Request {

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
            'name' => 'required|unique:roles,name,' . Request::get('id'),
            'display_name' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nama role diperlukan',
            'name.unique' => 'Nama Role sudah terpakai',
            'display_name.required' => 'Display Nama diperlukan'
        ];
    }

}
