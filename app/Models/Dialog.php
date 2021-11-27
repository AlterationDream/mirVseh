<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'pinned', 'tetatet', 'isArchived'];

    public function business_case() {
        return $this->belongsTo(\App\Models\BusinessCase::class);
    }

    public function users() {
        return $this->belongsToMany(\App\User::class);
    }

    public function messages() {
        return $this->hasMany(\App\Models\Message::class);
    }
}
