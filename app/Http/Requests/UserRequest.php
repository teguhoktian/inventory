<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
        if ($this->method() == 'PATCH') {
            $username_rules = 'required|alpha_dash|unique:users,username,' . $this->route('user')->id;
            $email_rules = 'required|email|unique:users,email,' . $this->route('user')->id;
            $password_rules = 'nullable';
        } else {
            $username_rules = 'required|alpha_dash|unique:users,username';
            $email_rules = 'required|email|unique:users,email';
            $password_rules = 'required';
        }

        return [
            'name' => 'required|max:255',
            'username' => $username_rules,
            'email' => $email_rules,
            'password' => $password_rules,
            'roles' => 'required',
            // 'penduduk' => 'required_if:roles,==,3'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Nama'),
            'username' => __('Username'),
            'email' => __('Email'),
            'password' => __('Password'),
            'roles' => __('Hak Akses'),
            // 'penduduk' => __('NIK Penduduk')
        ];
    }

    public function messages()
    {
        return [
            'penduduk.required_if' => __(':attribute harus diisi jika Hak Akses Penduduk Desa')
        ];
    }
}
