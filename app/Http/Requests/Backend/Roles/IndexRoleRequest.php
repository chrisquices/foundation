<?php

namespace App\Http\Requests\Backend\Roles;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page'            => ['nullable', 'integer', 'min:1'],
            'search'          => ['nullable', 'string', 'max:255'],
            'recordsPerPage'  => ['nullable', 'integer', 'in:10,20,50,100'],
            'sortByColumn'    => ['nullable', 'string', 'in:name'],
            'sortByDirection' => ['nullable', 'in:asc,desc'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->to(url()->current())
        );
    }
}
