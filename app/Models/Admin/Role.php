<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['role_name','slug','description','deletable','created_by','updated_by'];

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function admins(){
        return $this->hasOne(Admin::class);
    }


    public function scopeSearch($query,$text) {
        $query->where(function($q) use ($text) {
            $q->where("name","like","%".$text."%");
        })->orWhere("name","like","%".$text."%")->orWhere("description","like","%".$text."%");
    }
}
