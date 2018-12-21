<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'address',
        'address_2',
        'city',
        'state_id',
        'postal_code',
        'latitude',
        'longitude',
        'photo',
        'active',
        'user_id'
    ];
}
