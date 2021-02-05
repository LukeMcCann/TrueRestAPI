<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Models\Seller;

final class SellerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Seller $seller)
    {
        $transactions = $seller->products()
                               ->whereHas('transactions')
                               ->with('transactions')
                               ->get()
                               ->pluck('transactions')
                               ->unique('id')
                               ->values();

        return $this->showAll($transactions);
    }
}
