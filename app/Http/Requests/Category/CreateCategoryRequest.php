<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;

class CreateCategoryRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories,name',
            'active' => 'required|boolean'
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => (string)$this->get('name'),
            'active' => (bool)$this->get('active')
        ];
    }
}
