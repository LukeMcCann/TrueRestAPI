<?php

namespace App\Models;

use App\Models\Product;

final class Seller extends User
{
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
