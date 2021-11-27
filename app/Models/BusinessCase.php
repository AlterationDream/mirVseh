<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCase extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'slug', 'folder_path', 'pinned', 'isArchived'];

    public function users() {
        return $this->belongsToMany(\App\User::class)->wherePivot('is_guest', 0);
    }

    public function guests() {
        return $this->belongsToMany(\App\User::class)->wherePivot('is_guest', 1);
    }

    public function dialogs() {
        return $this->hasMany(\App\Models\Dialog::class);
    }

    public function folder() {
        return $this->hasOne(\App\Models\Folder::class);
    }
}
