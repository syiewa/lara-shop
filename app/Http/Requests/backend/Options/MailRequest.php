<?php namespace App\Http\Requests\backend\Options;

use App\Http\Requests\Request;

class MailRequest extends Request {

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
                    'mail_driver' => 'required',
                    'mail_host' => 'required',
                    'mail_port' => 'required',
                    'mail_username' => 'required',
                    'mail_password' => 'required',
                    
		];
	}

}
