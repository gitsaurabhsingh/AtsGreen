<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResalePropertyFloorPlan extends Model
{
    protected $guarded = [];

    public function resaleProperty()
    {
        return $this->belongsTo(ResaleProperty::class);
    }

    public function getImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::url($value);
    }
}
