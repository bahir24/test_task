<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'data' => $validator->errors()
            ])
        );
    }

    protected function prepareForValidation()
    {
        $this->merge(
            ['id' => ($this->route('product') ?? $this->route('category'))]
        );
    }
}
