<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'telefone' => 'required' . '|string',
            'email' => 'required' . '|string',
            'address' => 'required' . '|string',
            'facebook' => 'required' . '|string',
            'youtube' => 'required' . '|string',
            'linkedin' => 'required' . '|string',
            'whatssap' => 'required' . '|string',
        ];
    }
}
