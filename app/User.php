<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

final class User extends Authenticatable
{
    use Notifiable,
        HasApiTokens,
        HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}