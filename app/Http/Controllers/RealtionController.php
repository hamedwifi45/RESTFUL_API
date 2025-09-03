<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RealtionController extends Controller
{
    public function LessonTag($id){
        
        // try {
            $lessons = Lesson::FindOrFail($id)->Tags()->get();
            $fildes = array();
            $filtared = array();
            foreach($lessons as $lesson){
                $fildes['title'] = $lesson->name;
                // $fildes['body'] = $lesson->body;
                $filtared [] =$fildes;

            }

            return response()->json(['data' => $filtared ] , 200);
        // } catch (ModelNotFoundException $th) {
        //     return response()->json(['error' => 'THe Lessonapp NOT Found'],404);
        // }
    }
    public function TagLesson($id){
        // try {
            $lesson = Tag::FindOrFail($id)->lessons()->get();
            $fildes = array();
            $filtared = array();
            foreach($lesson as $tag){
                $fildes['title'] = $tag->title;
                $fildes['body'] = $tag->body;
                $filtared [] =$fildes;

            }
            return response()->json(['data' => $filtared ] , 200);
        // } catch (ModelNotFoundException $th) {
        //     return response()->json(['error' => 'THe Tag NOT Found'],404);
        // }
    }
    public function UserLesson($id){
        // try {
            $lessons = User::FindOrFail($id)->lessons()->get();
            $fildes = array();
            $filtared = array();
            foreach($lessons as $lesson){
                $fildes['title'] = $lesson->title;
                $fildes['body'] = $lesson->body;
                $filtared [] =$fildes;

            }
            return response()->json(['data' => $filtared ] , 200);
        // } catch (ModelNotFoundException $th) {
        //     return response()->json(['error' => 'THe User NOT Found'],404);
        // }
    }

}
