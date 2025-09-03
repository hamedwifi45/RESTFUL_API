<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RealtionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnceBasicMiddleware;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// ======================
//  مسارات المصادقة (Authentication)
// ======================

// مسارات المصادقة (لا تحتاج إلى مصادقة)
Route::post('login', [LoginController::class, 'login']);

// مسارات المصادقة (تحتاج إلى مصادقة)
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('logout', [LoginController::class, 'logout']);
//     Route::post('logout-all', [LoginController::class, 'logoutAll']);
//     Route::get('user', [LoginController::class, 'user']);
//     Route::post('refresh-token', [LoginController::class, 'refresh']);
//     Route::get('tokens', [LoginController::class, 'tokens']);
//     Route::delete('tokens/{tokenId}', [LoginController::class, 'deleteToken']);
// });

// مجموعة مسارات الإصدار الأول (v1) للـ API
Route::group(['prefix' => 'v1'], function () {

    // ======================
    //  مسارات الدروس (Lessons)
    // ======================
    
    Route::apiResource('lesson',LessonController::class);

    // ======================
    //  مسارات المستخدمين (Users)
    // ======================
    
    Route::apiResource('user',UserController::class);

    // ======================
    //  مسارات الوسوم (Tags)
    // ======================
    
        Route::apiResource('tag',TagController::class);

    // ======================
    //  مسارات العلاقات (Realtion)
    // ======================

    Route::get('user/{id}/lesson',[RealtionController::class , 'UserLesson']);
    Route::get('tag/{id}/lesson',[RealtionController::class , 'TagLesson']);
    Route::get('lesson/{id}/tag',[RealtionController::class , 'LessonTag']);
    


    // ======================
    //  مسارات إعادة التوجيه (Redirects)
    // ======================
    
    // مسار قديم - تم إهماله (يُظهر رسالة)
    Route::any('oldlesson', function () {
        $message ='This is not update api';
        return response()->json($message,404);
    });
    
    // إعادة توجيه المسار القديم إلى الجديد
    Route::redirect('oldlesson', 'lesson');
});