<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Foundation\Http\FormRequest;

class DeleteManyUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'userIds' => ['required', 'array'],
        ];
    }
}
