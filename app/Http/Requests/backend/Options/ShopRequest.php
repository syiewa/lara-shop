<?php namespace App\Http\Requests\backend\Options;

use App\Http\Requests\Request;

class ShopRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
                    'product_perpage_front' => 'min:1|required|numeric',
                    'product_perpage_admin' => 'min:1|required|numeric',
                    'display_mode' => 'required',
                    'category_product_count' => 'required',
		];
	}

}
