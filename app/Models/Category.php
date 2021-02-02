<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

final class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Define the products relationship 
     * 
     * many -> many
     * 
     * @var relationship
     */
    public function products() 
    {
        return $this->belongsToMany(Product::class);
    }
}
