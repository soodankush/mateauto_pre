<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreLaunchEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'is_verified',
        'email_verified_at',
        'token',
    ];
}
