<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id',
    ];

    /**
     * Define the buyer relationship.
     * 
     * @var relationship
     */
    public function buyer() 
    {
        return $this->belongsTo(Buyer::class);
    }

    /**
     * Define the seller relationship,
     * 
     * @var relationship
     */
    public function seller() 
    {
        return $this->belongsTo(Seller::class);
    }

}
