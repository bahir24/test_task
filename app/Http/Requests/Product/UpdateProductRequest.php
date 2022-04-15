<?php

namespace App\Http\Requests\Product;


use App\Http\Requests\ApiRequest;

class UpdateProductRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => "unique:products,name,{$this->route('product')}",
            'price' => 'numeric',
            'active' => 'boolean',
            'category' => 'array|min:2|exists:categories,id',
            'id' => 'exists:products,id'
        ];
    }
}
