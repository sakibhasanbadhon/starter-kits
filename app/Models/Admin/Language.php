<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'direction',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Provide a `dir` attribute accessor for code that expects ->dir
    public function getDirAttribute()
    {
        return $this->direction ?? 'ltr';
    }

    public static function getDefault()
    {
        return self::where('status', true)->first() ?? self::first();
    }

    public static function getActive()
    {
        return self::where('status', true)->get();
    }
}
