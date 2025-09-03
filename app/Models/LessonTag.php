<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonTag extends Model
{
        use HasFactory;

    protected $fillable = ['Lesson_id' , 'Tag_id'];
    
}
