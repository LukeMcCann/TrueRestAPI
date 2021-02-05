<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class ProductCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $categories = $product->categories;

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductCategoryRequest $request, Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);

        return $this->showAll($product->categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Category $category) 
    {
        $this->checkCategory($product, $category);

        $product->categories()->detach($category->id);

        return $this->showAll(
            $product->categories,
            JsonResponse::HTTP_NO_CONTENT
        );
    }

    /**
     * Validates the category is the assigned category of the specified product.
     *
     * @param Seller $seller
     * @param Product $product
     * 
     * @return void
     */
    private function checkCategory(Product $product, Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            throw new HttpException(
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'The category specified is not an actual category assigned to the product.'
            );
        }
    }
}
