<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\JsonResponse;

final class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::has('products')->get();

        return new JsonResponse([
            'data' => $sellers
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $seller = Seller::has('products')->findOrFail($id);

        return new JsonResponse([
            'data' => $seller
        ], JsonResponse::HTTP_OK);
    }

}
