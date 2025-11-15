<?php

namespace App\Http\Requests\Backend\Permissions;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexPermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page'            => ['nullable', 'integer', 'min:1'],
            'search'          => ['nullable', 'string', 'max:255'],
            'recordsPerPage'  => ['nullable', 'integer', 'in:10,20,50,100'],
            'sortByColumn'    => ['nullable', 'string', 'in:category,name,code'],
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
