<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:10'
        ];
    }
}
