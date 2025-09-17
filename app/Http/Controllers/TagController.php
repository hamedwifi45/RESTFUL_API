<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 15);
        $limit = $limit > 50 ? 50 : $limit;
        $tags = TagResource::collection(Tag::paginate($limit)) ;
        return $tags->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);
        $tags = new TagResource(Tag::create($request->all()));
        return $tags->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
         $tags = new TagResource($tag);
        return $tags->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $tags = new TagResource($tag->update($request->all()));
        return $tags->response()->setStatusCode(200, 'the Tag update نجح');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();
        return response(null, 204); // رمز الحالة: No Content
    }
}
