<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use Illuminate\Http\JsonResponse;

final class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers = Buyer::has('transactions')->get();

        return new JsonResponse([
            'data' => $buyers
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
        $buyer = Buyer::has('transactions')->findOrFail($id);

        return new JsonResponse([
            'data' => $buyer
        ], JsonResponse::HTTP_OK);
    }
}
