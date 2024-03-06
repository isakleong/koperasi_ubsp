<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword, MustVerifyEmailTrait;

    protected $fillable = [
        'email',
        'password',
        'mothername',
        'memberId',
        'fname',
        'lname',
        'birthplace',
        'birthdate',
        'address',
        'workAddress',
        'phone',
        'ktp',
        'kk',
        'status',
        'registDate',
        'joinDate',
        'exitDate',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userAccount(){
        return $this->hasMany(UserAccount::class, 'memberId', 'memberId');
    }
}
