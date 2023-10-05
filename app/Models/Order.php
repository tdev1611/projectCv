<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'code',
        'user_id',
        'info_id',
        'code_discount_id',
        'total',
        'items',
        'note',
        'status',
    ];

    function user(){
        return $this->belongsTo(User::class);
    }
}
