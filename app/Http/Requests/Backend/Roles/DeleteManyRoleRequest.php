<?php

namespace App\Http\Requests\Backend\Roles;

use Illuminate\Foundation\Http\FormRequest;

class DeleteManyRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'roleIds' => ['required', 'array'],
        ];
    }
}
