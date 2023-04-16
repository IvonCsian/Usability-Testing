<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable, HasApiTokens;

    protected $table = 'admin';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [];
}
