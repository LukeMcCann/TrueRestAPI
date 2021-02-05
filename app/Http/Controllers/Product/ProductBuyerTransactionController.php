<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreProductBuyerTransactionRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Json;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductBuyerTransactionRequest $request, Product $product, User $buyer)
    {
        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse(
                'The buyer must be different from the seller.',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!$buyer->isVerified()) {
            return $this->errorResponse(
                'The buyer must be a verified user.',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if (!$product->seller->isVerified()) {
            return $this->errorResponse(
                'The seller must be a verified user.',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );   
        }

        if (!$product->isAvailable()) {
            return $this->errorResponse(
                'The product is not available.',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse(
                'The product is out of stock.',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return DB::transaction(
            function () use ($request, $product, $buyer) {
                $product->quantity -= $request->quantity;
                $product->save();

                $transaction = Transaction::create([
                    'quantity' => $request->quantity,
                    'buyer_id' => $buyer->id, 
                    'product_id' => $product->id,
                ]);
                return $this->showOne($transaction, JsonResponse::HTTP_CREATED);
            }
        );
    }
}
