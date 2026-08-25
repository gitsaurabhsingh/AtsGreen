<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFloorPlan extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::url($value);
    }
}

