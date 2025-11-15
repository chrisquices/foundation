<?php

namespace App\Http\Requests\Backend\Roles;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'max:255'],
            'permissionIds'   => ['nullable', 'array'],
            'permissionIds.*' => ['integer', 'exists:permissions,id'],
        ];
    }
}
