<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function lessons()
    {
        $this->belongsToMany(Lesson::class , "lessonstags", 'tags_id' , 'lesson_id');
    }
}
