<?php

namespace App\Http\Requests\backend\Products;

use App\Http\Requests\Request,Entrust;

class CategoryRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Entrust::can(['category-create', 'category-update'], true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        return [
            //
            'name' => 'required|unique:product_category,name,' . Request::get('id'),
            'image' => 'image|max:2048',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nama Diperlukan',
            'name.unique' => 'Nama Category sudah terpakai',
            'image.image' => 'File yang diperbolehkan hanya berbentuk image',
            'image.max' => 'maksimal ukuran file 2mb'
        ];
    }

}
