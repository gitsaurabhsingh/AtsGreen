<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_logo',
        'footer_logo',
        'hero_heading',
        'hero_subheading',
        'hero_bg_image',
        'footer_description',
        'footer_address',
        'footer_phone',
        'footer_email',
        'about_content',
        'about_image',
        'contact_content',
        'contact_image',
        'social_facebook',
        'social_youtube',
        'social_instagram',
        'about_side_image',
        'stat_1_number',
        'stat_1_label',
        'stat_2_number',
        'stat_2_label',
        'stat_3_number',
        'stat_3_label'
    ];

    public function getHeaderLogoAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getFooterLogoAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getHeroBgImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getAboutImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getContactImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }

    public function getAboutSideImageAttribute($value)
    {
        if (!$value) return null;
        if (str_starts_with($value, 'http')) {
            return $value;
        }
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($value);
    }
}

