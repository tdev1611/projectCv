<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = 'category_products';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'cat_parent',
        'prioty',

    ];


    // admin 

    function productsAdmin()
    {
        return $this->hasMany(Product::class)->where('status', 1)->limit(12);
    }

    function getProductsBycateAdmin()
    {
        $products = $this->productsAdmin;
        foreach ($this->children as $child) {
            $products = $products->merge($child->getProductsBycateAdmin());
        }
        return $products;
    }


    // client
    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'cat_parent')->where('status', 1);
    }


    function products()
    {
        return $this->hasMany(Product::class)->where('status', 1)->limit(12);
    }

    function getProductsBycate()
    {
        $products = $this->products;
        foreach ($this->children as $child) {
            $products = $products->merge($child->getProductsBycate());
        }
        return $products;
    }
}
