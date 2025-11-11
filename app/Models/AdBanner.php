<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'link',
        'position',
        'is_active',
    ];
}
