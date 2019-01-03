<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

final class Country extends Model
{
    protected $fillable = ['name', 'code'];
}