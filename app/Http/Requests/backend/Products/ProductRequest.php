<?php

namespace App\Http\Requests\backend\Products;

use App\Http\Requests\Request,Entrust;

class ProductRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Entrust::can(['product-create', 'product-update'], true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
            'id_category' => 'required',
            'product_name' => 'required|unique:product,product_name,' . Request::get('id'),
            'product_price' => 'min:0',
            'image[]' => 'image',
            'value[]' => 'required_with:name[]'
        ];
    }

    public function messages() {
        return [
            'id_category.required' => 'Category diperlukan',
            'product_name.required' => 'Nama Product Diperlukan',
            'product_name.unique' => 'Nama Product sudah dipakai',
            'image[].image' => 'File harus berbentuk gambar (jpg,jpeg,png,bmp)',
            'value.required_with' => 'Nama attribute diperlukan',
        ];
    }

}
