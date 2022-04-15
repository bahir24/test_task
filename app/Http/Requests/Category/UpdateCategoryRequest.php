<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\ApiRequest;

class UpdateCategoryRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => "unique:categories,name,{$this->route('category')}",
            'id' => 'required|exists:categories,id'
        ];
    }
}
