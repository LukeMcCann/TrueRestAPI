<?php 

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * SellerScope
 * 
 * Laravel Global scope for the buyer class.
 * Allows for constraints to all queries for the Seller Model.
 * 
 * This global scope is used on all Seller queries, specified
 * within the Seller Model.
 */
final class SellerScope implements Scope
{
    /**
     * Applies the has('products') constraint to the
     * provided model.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->has('products');
    }
}