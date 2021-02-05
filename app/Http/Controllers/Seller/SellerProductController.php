<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreSellerProductRequest;
use App\Http\Requests\UpdateSellerProductRequest;
use App\Models\Seller;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class SellerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $products = $seller->products;

        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellerProductRequest $request, User $seller)
    {
        $data = $request->all();

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = 'schecter_c8_silver_mountain.jpg';
        $data['seller_id'] = $seller->id;

        $product = Product::create($data);

        return $this->showOne($product);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerProductRequest $request, Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);

        $product->fill($request->only([
            'name',
            'description',
            'quantity',
        ]));

        if ($request->has('status')) {
            $product->status = $request->status;
            
            if ($product->isAvailable() && 
                0 == $product->categories()->count) {
                    return $this->errorResponse(
                        'An active product must have at least one category',
                        JsonResponse::HTTP_CONFLICT
                    );
                }
        }

        if ($product->isClean()) {
            return $this->errorResponse(
                'A new value must be specified to update',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $product->save();

        return $this->showOne($product);
    }

    /**
     * Validates the seller is the assigned seller of the specified product.
     *
     * @param Seller $seller
     * @param Product $product
     * 
     * @return void
     */
    private function checkSeller(Seller $seller, Product $product)
    {
        if ($seller->id != $product->seller_id) {
            throw new HttpException(
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
                'The seller specified is not the actual seller of the product.'
            );
        }
    }
}
