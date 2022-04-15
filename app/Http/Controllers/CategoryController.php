<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $categoryRequest
     * @return JsonResource
     */
    public function store(CreateCategoryRequest $categoryRequest): JsonResource
    {
        Category::create($categoryRequest->toArray());

        return new JsonResource(['result' => 'success']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $updateCategoryRequest
     * @param int $id
     * @return JsonResource
     */
    public function update(UpdateCategoryRequest $updateCategoryRequest, int $id): JsonResource
    {
        Category::findOrFail($id)
            ->update($updateCategoryRequest->toArray());

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
            Category::findOrFail($id)->delete($id);
        } catch (\Exception $e) {
            throw new HttpResponseException(
                response()->json([
                    'success' => false,
                    'data' => 'Category not found'
                ])
            );
        }

        return new JsonResource(['result' => 'success']);
    }
}
