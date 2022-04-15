<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\ApiRequest;

class CreateProductRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'active' => 'required|boolean',
            'category' => 'required|array|min:2|exists:categories,id',
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => (string)$this->get('name'),
            'price' => (int)$this->get('price'),
            'active' => (bool)$this->get('active'),
        ];
    }
}
