<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
        protected $fillable = [
            'id',
            'question',
            'question_img',
            'x_start',
            'x_end',
            'y_start',
            'y_end'
    ];

    protected $hidden = [];
    use HasFactory;

    public function result()
    {
        return $this->hasMany(Result::class);
    }
}
