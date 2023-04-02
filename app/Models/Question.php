<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
        protected $fillable = [
        'question',
        'question_img',
        'time'
    ];

    protected $hidden = [];
    use HasFactory;

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
