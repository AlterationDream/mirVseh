<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'fullname',
        'email',
        'phone',
        'experience',
        'age',
        'price',
        'contract_date',
        'region',
        'address',
        'position',
        'description',
        'passport',
        'doc'];
}
