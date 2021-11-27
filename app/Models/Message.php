<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'edited', 'user_id', 'dialog_id', 'isArchived'];

    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function dialog() {
        return $this->belongsTo(\App\Models\Dialog::class);
    }
}
