<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CodeDiscount extends Model
{
    use HasFactory;
    use Searchable;
    protected  $table = 'code_discounts';
    protected $fillable = [
        'code',
        'qty',
        'amount',
        'note',
        'status',
    ];
    public function searchableAs()
    {
        return 'code_discounts_index';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();
        return [
            'id' => $array['id'],
            'note' => $array['note'],
            'code' => $array['code'],
            'key' => 'Mã giảm giá',
        ];
    }
}
