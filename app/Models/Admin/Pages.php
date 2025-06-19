<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $casts = [
        'title'   => 'object',
        'details' => 'object'
    ];

    protected $guarded = ['id'];
}
