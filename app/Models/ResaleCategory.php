<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResaleCategory extends Model
{
    protected $fillable = ['name', 'slug', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = \Illuminate\Support\Str::slug($category->name);
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
        });
    }

    public function resaleProperties()
    {
        return $this->hasMany(ResaleProperty::class);
    }
}
