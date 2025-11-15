<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {

        return [
            'name'     => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'roleIds'   => ['required', 'array', 'min:1'],
            'roleIds.*' => ['integer', 'exists:roles,id'],
        ];
    }
}
