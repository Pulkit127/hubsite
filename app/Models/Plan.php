<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'price', 'duration_days', 'description'];

    public function userPlans()
    {
        return $this->hasMany(UserPlan::class);
    }

}
