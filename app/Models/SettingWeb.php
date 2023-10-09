<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWeb extends Model
{
    use HasFactory;
    protected $table = 'setting_webs';

    protected $fillable = [
        'status',
        'image',
        'desc',
        'content',
        'title',

    ];
}
