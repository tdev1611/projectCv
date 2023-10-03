<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable =[
        'rowId',
        'name',
        'user_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
        'options',
    ];
}
