<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'isArchived'];

    public function business_case() {
        return $this->belongsTo(\App\Models\BusinessCase::class);
    }

    public function files() {
        return $this->hasMany(\App\Models\File::class);
    }
}
