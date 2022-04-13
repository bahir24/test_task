<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'unique:products,name',
            'price' => 'numeric',
            'active' => 'boolean'
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name')
                ? (string)$this->get('name')
                : null,
            'price' => $this->get('price')
                ? (int)$this->get('price')
                : null,
            'active' => $this->get('active')
                ? (bool)$this->get('active')
                : null
        ];
    }
}
