<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAlias extends Model
{
    use HasFactory;

    protected $fillable = [
        'temporary_email_id',
        'real_email',

    ];



    public function temporaryEmail()
    {
        return $this->belongsTo(TemporaryEmail::class);
    }
}
