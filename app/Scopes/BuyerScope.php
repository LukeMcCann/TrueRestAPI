<?php 

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * BuyerScope
 * 
 * Laravel Global scope for the buyer class.
 * Allows for constraints to all queries for the Buyer Model.
 * 
 * This global scope is used on all Buyer queries, specified
 * within the Buyer Model.
 */
class BuyerScope implements Scope
{
    /**
     * Applies the has('transactions') constraint to the
     * provided model.
     *
     * @param Builder $builder
     * @param Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->has('transactions');
    }
}
