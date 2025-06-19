<?php

namespace App\Models\Admin;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];


    protected $appdens = [
        'fullName',
        'statusType'
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

    public function getUserImageAttribute(){
        $image = $this->image;

        if($image == null) {
            $image = '<span class="image_text">'.substr($this->first_name,0,1).'</span>';
        }else {
            $image = '<img src="'.getImagePath($image, 'admin-profile').'" alt="">';
        }

        return $image;
    }

    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name ?? '';
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission){
        return $this->role->permissions->where('slug', $permission)->first() ? true : false;
    }

    public function scopeSearch($query,$text) {
        $query->where(function($q) use ($text) {
            $q->where("first_name","like","%".$text."%");
        })->orWhere("last_name","like","%".$text."%")->orWhere("user_name","like","%".$text."%");
    }
}
