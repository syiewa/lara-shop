<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ShippingRequest extends Request {

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
                    'email' => 'required|email|unique:users,email,' . Request::get('user_id'),
                    'first_name' => 'required',
                    'address' => 'required',
                    'phone' => 'required',
                    'mob_phone' => 'required'
		];
	}

}
