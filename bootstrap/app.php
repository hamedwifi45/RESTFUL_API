<?php

use App\Http\Middleware\OnceBasicMiddleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withSchedule(function (Illuminate\Console\Scheduling\Schedule $schedule) {
        // يمكنك تركها فارغة إذا كنت تستخدم الجدولة في routes/console.php فقط
    })
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(OnceBasicMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->renderable(function(MethodNotAllowedHttpException $e){
        //     return response()->json(['error'=>'not True Request Type'],405);
        // });
        // $exceptions->renderable(function(ModelNotFoundException $e){
        //                 return response()->json(['error' => ' NOT F1ound'],404);
        //             });
        // $exceptions->renderable(function(NotFoundHttpException  $e){
        //                 return response()->json(['error' => ' NOT Found3'],404);
        //             });
        // $exceptions->renderable(function(Throwable  $e){
        //                 return response()->json(['error' => 'Some thing is wrong'],404);
        //             });
    })->create();
