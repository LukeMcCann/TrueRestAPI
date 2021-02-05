<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Category extends Model
{
    use SoftDeletes, HasFactory;
    
    protected $dates = ['deleted_at'];
    
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
     * The attributes that are to be hidden from the response.
     *
     * @var array
     */
    protected $hidden = [
        'pivot'
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
