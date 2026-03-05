<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UiSection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'value'     => 'object',
    ];

    public function scopeDisplayData($query,$slug) {
        return $this->where("key",$slug);
    }

}
