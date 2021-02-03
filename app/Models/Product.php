<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Product extends Model
{ 
    use SoftDeletes, HasFactory;

    protected $dates = ['deleted_at'];

    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'status',
        'image',
        'seller_id',
    ];

    /**
     * Check a products availability
     * 
     * @var boolean
     */
    public function isAvailable() 
    {
        return $this->status == Product::AVAILABLE_PRODUCT;
    }

    /**
     * Defube the category relationship
     * 
     * many -> many
     * 
     * @var relationship
     */
    public function categories() 
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Define the transaction relationship
     * 
     * @var realtionship
     */
    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Define the seller relationship
     * 
     * The model which has the foreign key is the model
     * that belongs to.
     * 
     * @var realtionship
     */
    public function seller() 
    {
        return $this->belongsTo(Seller::class);
    }
}
