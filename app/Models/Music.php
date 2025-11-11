<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;

    // Table name (optional if Laravel follows naming convention)
    protected $table = 'music';

    // Mass assignable fields
    protected $fillable = [
        'title',
        'music_file',
        'category_id',
    ];

    /**
     * Optional: Accessor for full file URL
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->music_file);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
