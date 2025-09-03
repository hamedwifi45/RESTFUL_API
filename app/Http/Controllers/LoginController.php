<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
    dd($request);
    if(Auth::attempt(['email' => $request->email , 'password' => $request->password])){
        $user = Auth::user();
        $token = $user->createToken('Access Token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الدخول بنجاح',
            'user' => new UserResource($user),
            'token' => $token
        ]);  
    }
    return response()->json([
        'success' => false,
        'message' => 'بيانات الدخول غير صحيحة'
    ] , 401);

    }
}
// ذكاء اصطناعي
// class LoginController extends Controller
// {
//     /**
//      * تسجيل الدخول والحصول على رمز API
//      */
//     public function login(LoginRequest $request)
//     {
//         // البيانات تم التحقق منها تلقائياً بواسطة LoginRequest

//         // البحث عن المستخدم
//         $user = User::where('email', $request->email)->first();

//         // التحقق من وجود المستخدم وصحة كلمة المرور
//         if (!$user || !Hash::check($request->password, $user->password)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'بيانات الدخول غير صحيحة'
//             ], 401);
//         }

//         // إنشاء رمز API جديد
//         $token = $user->createToken('api-token')->plainTextToken;

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تسجيل الدخول بنجاح',
//             'data' => [
//                 'user' => [
//                     'id' => $user->id,
//                     'name' => $user->name,
//                     'email' => $user->email,
//                 ],
//                 'token' => $token,
//                 'token_type' => 'Bearer'
//             ]
//         ], 200);
//     }

//     /**
//      * تسجيل الخروج وحذف الرمز الحالي
//      */
//     public function logout(Request $request)
//     {
//         // حذف الرمز الحالي
//         $request->user()->currentAccessToken()->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تسجيل الخروج بنجاح'
//         ], 200);
//     }

//     /**
//      * تسجيل الخروج من جميع الأجهزة (حذف جميع الرموز)
//      */
//     public function logoutAll(Request $request)
//     {
//         // حذف جميع رموز المستخدم
//         $request->user()->tokens()->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تسجيل الخروج من جميع الأجهزة بنجاح'
//         ], 200);
//     }

//     /**
//      * الحصول على معلومات المستخدم الحالي
//      */
//     public function user(Request $request)
//     {
//         return response()->json([
//             'success' => true,
//             'data' => [
//                 'user' => [
//                     'id' => $request->user()->id,
//                     'name' => $request->user()->name,
//                     'email' => $request->user()->email,
//                     'email_verified_at' => $request->user()->email_verified_at,
//                     'created_at' => $request->user()->created_at,
//                 ]
//             ]
//         ], 200);
//     }

//     /**
//      * تجديد الرمز (إنشاء رمز جديد وحذف القديم)
//      */
//     public function refresh(Request $request)
//     {
//         // حذف الرمز الحالي
//         $request->user()->currentAccessToken()->delete();

//         // إنشاء رمز جديد
//         $token = $request->user()->createToken('api-token')->plainTextToken;

//         return response()->json([
//             'success' => true,
//             'message' => 'تم تجديد الرمز بنجاح',
//             'data' => [
//                 'token' => $token,
//                 'token_type' => 'Bearer'
//             ]
//         ], 200);
//     }

//     /**
//      * عرض جميع الرموز النشطة للمستخدم
//      */
//     public function tokens(Request $request)
//     {
//         $tokens = $request->user()->tokens()->get(['id', 'name', 'created_at', 'last_used_at']);

//         return response()->json([
//             'success' => true,
//             'data' => [
//                 'tokens' => $tokens
//             ]
//         ], 200);
//     }

//     /**
//      * حذف رمز محدد
//      */
//     public function deleteToken(Request $request, $tokenId)
//     {
//         $token = $request->user()->tokens()->where('id', $tokenId)->first();

//         if (!$token) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'الرمز غير موجود'
//             ], 404);
//         }

//         $token->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'تم حذف الرمز بنجاح'
//         ], 200);
//     }
// }
