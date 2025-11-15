<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'password'     => ['required', 'string', 'max:255', 'confirmed'],
        ];
    }
}
