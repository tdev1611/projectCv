<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetNew extends Model
{
    use HasFactory;
    protected $table  = 'get_news';
    protected $fillable = ['user_id', 'status','email'];
}
