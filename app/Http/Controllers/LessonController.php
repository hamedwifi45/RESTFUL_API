<?php

namespace App\Http\Controllers;

use App\Http\Middleware\OnceBasicMiddleware;
use App\Http\Resources\LessonResource;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 15);
        $limit = $limit > 50 ? 50 : $limit; 
        $lesson = LessonResource::collection(Lesson::paginate($limit));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Lesson::class);
        $lesson = new LessonResource(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200 , 'the lesson saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
         $lessons = new LessonResource($lesson);
         return $lessons->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $lesson->update($request->all());
        $lessons = new LessonResource($lesson);
        return $lessons->response()->setStatusCode(200 , 'the Lesson saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $this->authorize('delete', $lesson);
        $lesson->delete();
        return response(null, 204); // رمز الحالة: No Content
    }
}
