<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'color_products', 'color_id', 'product_id');
    }
 
}
