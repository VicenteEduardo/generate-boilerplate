<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required' . '|string',
            'description' => 'required',
            'photo' => 'required' . '|string',
            'price' => 'required' . '|string',
        ];
    }
}
