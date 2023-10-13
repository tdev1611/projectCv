<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;
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
    public function searchableAs()
    {
        return 'products_index';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $relatedColors = $this->colors->pluck('name')->toArray();
        $relatedSizes = $this->sizes->pluck('name')->toArray();

        $priceSale = $this->price  - ($this->discount * $this->price) / 100;
        $discount = $this->discount > 0;
        return [
            'id' => $array['id'],
            'name' => $array['name'],
            'desc' => $array['desc'],
            'price' => $array['price'],
            'detail' => $array['detail'],
            'discount' => $discount,
            'sale' => $priceSale,
            // 'category' => $relatedCategory,
            'colors' => $relatedColors,
            'sizes' => $relatedSizes,
            'code' => $array['code'],
        ];
    }




    function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
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
