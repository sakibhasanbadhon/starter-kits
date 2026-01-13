<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'mobile_code',
        'mobile',
        'full_mobile',
        'password',
        'image',
        'address',
        'email_verified',
        'sms_verified',
        'kyc_verified',
        'two_factor_verified',
        'two_factor_status',
        'two_factor_secret',
        'device_id',
        'status',
        'created_by',
        'updated_by'
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
        'password' => 'hashed',
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


    public function scopeSearch($query,$text) {
        $query->where(function($q) use ($text) {
            $q->where("email","like","%".$text."%");
        })->orWhere("username","like","%".$text."%");
    }
}
