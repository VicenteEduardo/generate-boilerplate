<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'state' => 'required' . '|string',
            'typewriter' => 'required' . '|string',
            'body' => 'required',
            'date' => 'required' . '|date',
            'path' => 'required' . '|string',
        ];
    }
}
