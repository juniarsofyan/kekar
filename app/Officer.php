<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    protected $fillable = ['name', 'birthdate', 'gender', 'phone', 'email', 'address'];
}
