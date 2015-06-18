<?php

namespace App\Http\Requests\backend\User;

use App\Http\Requests\Request,
    Entrust;

class UserRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Entrust::can(['user-create', 'user-update'], true);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        if (Request::get('id')) {
            $password = 'min:5';
        } else {
            $password = 'required|min:5';
        }
        return [
            //
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . Request::get('id'),
            'password' => $password,
            'role' => 'required'
        ];
    }

    public function messages() {
        return [
            'first_name.required' => 'Nama dibutuhkan',
            'email.required' => 'Email dibutuhkan',
            'email.email' => 'Format email tidak benar',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password dibutuhkan',
            'password.min' => 'Password Minimal 5 karakter',
            'role.required' => 'Role dibutuhkan'
        ];
    }

}
