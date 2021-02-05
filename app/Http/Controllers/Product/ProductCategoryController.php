<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Models\Product;
use App\Models\Category;

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
        $product->categories()->attach($category);

        return $this->showAll($product->categories);
    }
}
