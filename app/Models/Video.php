<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','category_id', 'title', 'description', 'video_url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
