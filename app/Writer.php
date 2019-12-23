<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Writer as Authenticatable;

class Writer extends Authenticatable
{
    protected $guard = 'writer';

    protected $fillable =['name','email','password','is_admin'];
}

