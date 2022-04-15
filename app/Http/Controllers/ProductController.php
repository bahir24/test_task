<?php

namespace App\Http\Controllers;

use App\Filters\ProductsFilter;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ApiRequest $productRequest
     * @return JsonResource
     */
    public function index(Request $request): JsonResource
    {
        $filer = new ProductsFilter($request);

        return new JsonResource([Product::filter($filer)->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $createProductRequest
     * @return JsonResource
     */
    public function store(CreateProductRequest $createProductRequest): JsonResource
    {
        $product = Product::create($createProductRequest->toArray());

        $product->categories()
            ->sync($createProductRequest->get('categories'));

        return new JsonResource(['result' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $updateProductRequest
     * @param int $id
     * @return JsonResource
     */
    public function update(UpdateProductRequest $updateProductRequest, int $id): JsonResource
    {
        $product = Product::withTrashed()->findOrFail($id);

        $product->update($updateProductRequest->toArray());

        $product->categories()->sync($updateProductRequest->get('category'));

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

        try {
            Product::findOrFail($id)->delete($id);
        } catch (\Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'data' => 'Product not found'
                ])
            );
        }

        return new JsonResource(['result' => 'success']);
    }
}
