<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResalePropertyFaq extends Model
{
    protected $guarded = [];

    public function resaleProperty()
    {
        return $this->belongsTo(ResaleProperty::class);
    }
}
