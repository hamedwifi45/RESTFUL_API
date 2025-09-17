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
        $this->middleware('auth:sanctum')->except(['index' ]);
    }
    /**
     * عرض قائمة بجميع المستخدمين.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit', 15);
        $limit = $limit > 50 ? 50 : $limit;
        $users =  UserResource::collection(User::paginate($limit));
        return $users->response()->setStatusCode(200);
    }

    /**
     * تخزين مورد جديد في قاعدة البيانات.
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
     * عرض مورد محدد.
     */
    public function show(User $user)
    {
        $users = new UserResource($user);

        return $users->response()->setStatusCode(200);
    }

    /**
     * تحديث مورد محدد في قاعدة البيانات.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->all());
        $users = new UserResource($user->fresh());
        return $users->response()->setStatusCode(200);
    }

    /**
     * حذف مورد محدد من قاعدة البيانات.
     */
    public function destroy(User $user)
    {
        $this->authorize('update', $user);
        $user->delete();
        return response(null, 204); // رمز الحالة: لا يوجد محتوى
    }
}

