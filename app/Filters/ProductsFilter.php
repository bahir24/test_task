<?php

namespace App\Filters;

use App\Http\Requests\ApiRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductsFilter
{
    protected Builder $builder;

    public function __construct(private Request $request)
    {}

    public function filters(): ?array
    {
        return $this->request->query();
    }

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value], null));
            }
        }

        return $this->builder;
    }

    public function name(string $name): Builder
    {
        return $this->builder->where('name', 'like', "%$name%");
    }

    public function categoryId(int $categoryId): Builder
    {
        return $this->builder->whereHas('categories', function($q) use ($categoryId){
            $q->where('id', $categoryId);
        });
    }

    public function categoryName(string $categoryName): Builder
    {
        return $this->builder->whereHas('categories', function($q) use ($categoryName){
            $q->where('name', $categoryName);
        });
    }

    public function price(string $prices): Builder
    {
        return $this->builder->whereBetween('price', explode(',', $prices, 2));
    }

    public function active($active): Builder
    {
        return $this->builder
            ->where(
                'active',
                filter_var($active, FILTER_VALIDATE_BOOLEAN)
            );
    }
}
