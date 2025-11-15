<?php

namespace App\Http\Requests\Backend\Preferences;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePreferenceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'value'    => ['required', 'string'],
        ];
    }
}
