<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required' . '|string',
            'photo' => 'required' . '|string',
            'email' => 'required' . '|string',
            'provider_id' => 'required' . '|string',
            'status' => 'required' . '|string',
            'level' => 'required' . '|string',
            'email_verified_at' => 'required' . '|date',
            'password' => 'required' . '|string',
            'remember_token' => 'required' . '|string',
        ];
    }
}
