<?php

namespace App\Http\Controllers;

use App\Http\Middleware\OnceBasicMiddleware;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function __construct(){
        // $this->middleware('auth:sanctum')->except(['index' ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =  UserResource::collection(User::all());
        return $users->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $users = new UserResource(User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => Hash::make($request->password) 
        ]));
        return $users->response()->setStatusCode(200);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $users = new UserResource($user);

        return $users->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       
        $users = new UserResource($user);
        $users->update($request->all());
        return $users->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204); // رمز الحالة: No Content
    }
}
