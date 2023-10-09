<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeDiscount extends Model
{
    use HasFactory;
    protected  $table = 'code_discounts';
    protected $fillable = [
        'code',
        'qty',
        'amount',
        'note',
        'status',
    ];
}
