<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemporaryEmail extends Model
{
    //
    protected $fillable = ['username', 'email', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
