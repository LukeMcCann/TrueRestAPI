<?php

namespace App\Models;

use App\Models\Transaction;
use App\Scopes\BuyerScope;

final class Buyer extends User
{
    /**
     * Overload the boot method to add custom Global scope.
     * 
     * BuyerScope adds constraint has('transactions') to all
     * queries.
     *
     * @return void
     */
    protected static function boot() 
    {
        parent::boot();

        static::addGlobalScope(new BuyerScope);
    }

    /**
     * Define the transactions relationship
     * 
     * @var relationship
     */
    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }
}
