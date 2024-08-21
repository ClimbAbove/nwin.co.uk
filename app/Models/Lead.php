<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'domain',
        'name',
        'email',
        'telephone',
        'product_type',
        'meta',
        'ppc_source',
        'flags',
    ];

    protected $casts = [
        'meta' => 'array',
    ];
}
