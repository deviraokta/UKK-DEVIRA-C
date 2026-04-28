<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'denda_per_hari',
        'denda_hilang',
    ];
}
