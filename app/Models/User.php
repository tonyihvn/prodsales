<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

// implements MustVerifyEmail
class User extends Authenticatable

{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'dob',
        'phone_number',
        'password',
        'address',
        'location',
        'role',
        'category',
        'about',
        'setting_id',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // USER OWNS MINISTRIES
    public function business()
    {
        return $this->hasMany(settings::class, 'user_id', 'id');
    }

    // USER OWNS MINISTRY GROUPS
    public function businessgroup()
    {
        return $this->hasMany(businessgroup::class, 'user_id', 'id');
    }

    // USER BELONGS TO ONE MINISTRY

    public function settings()
    {
        return $this->belongsTo(settings::class, 'setting_id', 'id');
    }


}
