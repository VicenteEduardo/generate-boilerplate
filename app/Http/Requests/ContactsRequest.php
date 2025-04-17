<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required' . '|string',
            'email' => 'required' . '|string',
            'subject' => 'required' . '|string',
            'name' => 'required' . '|string',
            'image' => 'required' . '|string',
            'uuid' => 'required' . '|string',
            'level' => 'required',
            'REMOTE_ADDR' => 'required' . '|string',
            'PATH_INFO' => 'required' . '|string',
            'USER_NAME' => 'required' . '|string',
            'USER_ID' => 'required' . '|string',
            'HTTP_USER_AGENT' => 'required' . '|string',
        ];
    }
}
