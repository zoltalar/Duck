<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class State extends Model
{
    protected $fillable = [
        'country_id',
        'name', 'abbr'
    ];
}