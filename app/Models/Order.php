<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Order extends Model
{
    use HasFactory;
    use Searchable;

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


    public function searchableAs()
    {
        return 'orders_index';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return [
            'id' => $array['id'],
            'code' => $array['code'],
            'total' => $array['total'],
            'note' => 'Đơn hàng',
        ];
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
    function discount_code()
    {
        return $this->belongsTo(CodeDiscount::class, 'code_discount_id');
    }
    function address()
    {
        return $this->belongsTo(ShippingAddress::class, 'info_id');
    }
}
