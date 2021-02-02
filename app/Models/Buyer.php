<?php

namespace App\Models;

use App\Models\Transaction;

final class Buyer extends User
{
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
