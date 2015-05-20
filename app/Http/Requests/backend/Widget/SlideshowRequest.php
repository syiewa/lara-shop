<?php

namespace App\Http\Requests\backend\Widget;

use App\Http\Requests\Request;

class SlideshowRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Entrust::has(['slideshow-create', 'slideshow-update'], true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            //
            'ss_name' => 'required',
            'ss_image' => 'required|image',
            'ss_url' => 'url',
        ];
    }

    public function messages() {
        return [
            'ss_name.required' => 'Title diperlukan',
            'ss_image.required' => 'Image diperlukan',
            'ss_image.image' => 'Hanya file jpg,bmp,gif,png yang diperbolehkan',
            'ss_url.url' => 'URL tidak valid',
        ];
    }

}
