<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'qty',
        'code',
        'category_product_id',
        'price',
        'discount',
        'detail',
        'desc',
        'images',
        'list_image',
        'features',
        'status',

    ];

    function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id', 'id');
    }

    function colors()
    {
        return $this->belongsToMany(Color::class, 'color_products', 'product_id', 'color_id');

    }

    function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id');

    }
}
