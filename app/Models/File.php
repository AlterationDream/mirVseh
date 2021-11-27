<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'filename', 'extension', 'dir', 'type', 'isArchived'];

    public function folder() {
        return $this->belongsTo(\App\Models\Folder::class);
    }
}
