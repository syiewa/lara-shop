<?php

namespace App\Http\Requests\backend\Page;

use App\Http\Requests\Request;

class PageRequest extends Request {

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
            'page_type' => 'required',
            "page_name" => "required",
            "page_slug" => 'required|unique:pages,page_slug,' . Request::get('id'),
        ];
    }

    public function messages() {
        return [
            'page_type' => 'Menu Type diperlukan',
            'page_name.required' => 'Title diperlukan',
            'page_slug.required' => 'Slug URL diperlukan',
            'page.slug.unique' => 'URL sudah terpakai',
        ];
    }

}
