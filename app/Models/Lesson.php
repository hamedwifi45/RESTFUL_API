<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [ 'body' , 'title','user_id'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function tag()
    {
        $this->belongsToMany(Tag::class , "lessonstags" , 'lesson_id', 'tags_id');
    }
}
