<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideshowsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'path' => 'required' . '|string',
            'title' => 'required' . '|string',
            'description' => 'required' . '|string',
            'link' => 'required' . '|string',
            'button' => 'required' . '|string',
            'name' => 'required' . '|string',
            'photo' => 'required' . '|string',
        ];
    }
}
