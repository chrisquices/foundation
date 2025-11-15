<?php

namespace App\Http\Requests\Backend\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
            'search' => ['nullable', 'string', 'max:255'],
            'recordsPerPage' => ['nullable', 'integer', 'in:10,20,50,100'],
            'sortByColumn' => ['nullable', 'string', 'in:name,last_name,email,email_verified_at,is_active,is_admin'],
            'sortByDirection' => ['nullable', 'in:asc,desc'],
            'isActive' => ['nullable', 'boolean'],
            'isAdmin' => ['nullable', 'boolean'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->to(url()->current())
        );
    }
}
