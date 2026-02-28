<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UiSection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];



    public function scopeGetData($query,$slug) {
        return $this->where("key",$slug);
    }

}
