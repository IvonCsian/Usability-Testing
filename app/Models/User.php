<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [];
    use HasFactory;

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
