<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductRequest $productRequest
     * @return JsonResource
     */
    public function index(ProductRequest $productRequest): JsonResource
    {

        dd($productRequest);

        return new JsonResource([]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $productRequest
     * @return JsonResource
     */
    public function store(ProductRequest $productRequest): JsonResource
    {
        (new Product($productRequest->toArray()))->save();

        return new JsonResource(['result' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $productRequest
     * @param int $id
     * @return JsonResource
     */
    public function update(ProductRequest $productRequest, int $id): JsonResource
    {
        Product::findOrFail($id)
            ->update(array_filter($productRequest->toArray(), null));

        return new JsonResource(['result' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResource
     */
    public function destroy(int $id): JsonResource
    {
        Product::findOrFail($id)->delete($id);

        return new JsonResource(['result' => 'success']);
    }
}
