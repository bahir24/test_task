<?php

namespace App\Filters;

use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Builder;

class ProductsFilter
{
    protected Builder $builder;

    public function __construct(ProductRequest $productRequest)
    {}

    public function filters()
    {
        return $this->productRequest->query();
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    public function name($name): Builder
    {
        return $this->builder->where('name', 'like', "%$name%");
    }

}
