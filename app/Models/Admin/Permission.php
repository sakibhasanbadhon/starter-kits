<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
