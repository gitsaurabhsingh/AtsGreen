<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['project_id', 'name', 'email', 'phone', 'whatsapp', 'message', 'source', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
