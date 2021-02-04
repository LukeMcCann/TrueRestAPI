<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Transaction extends Model
{
    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];
    
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
     * Define the product relationship.
     * 
     * @var relationship
     */
    public function product() 
    {
        return $this->belongsTo(Product::class);
    }

}
