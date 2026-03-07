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

    public function getStatusTypeAttribute() {
        $status_type = [];
        if($this->status){
            $status_type['name'] = "Active";
            $status_type['class'] = "badge-success";
        }else{
            $status_type['name'] = 'Deavtivate';
            $status_type['class'] = 'badge-danger';
        }
        return $status_type;
    }

    // Provide a `dir` attribute accessor for code that expects ->dir
    public function getDirAttribute()
    {
        return $this->direction ?? 'ltr';
    }

    public static function getDefault()
    {
        return self::where('status', true)->first() ?? self::first();
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    
}
