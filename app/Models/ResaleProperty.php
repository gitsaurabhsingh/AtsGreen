<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResaleProperty extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = \Illuminate\Support\Str::slug($property->title);
            }
        });

        static::updating(function ($property) {
            if ($property->isDirty('title')) {
                $property->slug = \Illuminate\Support\Str::slug($property->title);
            }
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function resaleCategory()
    {
        return $this->belongsTo(ResaleCategory::class);
    }

    public function floorPlans()
    {
        return $this->hasMany(ResalePropertyFloorPlan::class);
    }

    public function faqs()
    {
        return $this->hasMany(ResalePropertyFaq::class);
    }

    public function getFeaturedImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getLocationMapImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getSitePlanImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getPaymentPlanImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }
}
