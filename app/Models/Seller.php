<?php

namespace App\Models;

use App\Models\Product;
use App\Scopes\SellerScope;

final class Seller extends User
{
    /**
     * Overload the boot method to add custom Global scope.
     * 
     * BuyerScope adds constraint has('products') to all
     * queries.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SellerScope);
    }

    /**
     * Define the product relationship
     * 
     * @var realtionship
     */
    public function products() 
    {
        return $this->hasMany(Product::class);
    }
}
