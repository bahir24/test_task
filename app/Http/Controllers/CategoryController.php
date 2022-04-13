<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $categoryRequest
     * @return JsonResource
     */
    public function store(CategoryRequest $categoryRequest): JsonResource
    {
        (new Category($categoryRequest->toArray()))->save();

        return new JsonResource([]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $categoryRequest
     * @param int $id
     * @return JsonResource
     */
    public function update(CategoryRequest $categoryRequest, int $id): JsonResource
    {
        Category::findOrFail($id)
            ->update(array_filter($categoryRequest->toArray(), null));

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
        Category::findOrFail($id)->delete($id);

        return new JsonResource(['result' => 'success']);
    }
}
