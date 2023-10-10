<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'content', 'status', 'user_id',
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
