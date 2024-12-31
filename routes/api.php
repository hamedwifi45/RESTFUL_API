<?php

use App\Models\Lesson;
use App\Models\Tag;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => '/v1'], function () {
Route::get('lesson', function () {
    return Lesson::all();
});
Route::get('lesson/{id}', function ($id) {
    return Lesson::find($id);
});
Route::post('lesson', function (Request $request) {
    return Lesson::create($request::all());
});
Route::match(['put' , 'patch'],'lesson/{id}', function (Request $request , $id) {
    return Lesson::findOrFail($id)->update($request->all());
});
Route::delete('lesson/{id}', function ($id){
    Lesson::findOrFail($id)->delete();
    return 204;
});
Route::any('lessons' , function(){
    return "please update m3fen.com";
});
Route::get('user', function () {
    return User::all();
});
Route::get('user/{id}', function ($id) {
    return User::find($id);
});
Route::post('user', function (Request $request) {
    return User::create($request::all());
});
Route::match(['put' , 'patch'],'user/{id}', function (Request $request , $id) {
    return User::findOrFail($id)->update($request->all());
});
Route::delete('user/{id}', function ($id){
    User::findOrFail($id)->delete();
    return 204;
});
Route::get('tag', function () {
    return Tag::all();
});
Route::get('tag/{id}', function ($id) {
    return Tag::find($id);
});
Route::post('tag', function (Request $request) {
    return tag::create($request::all());
});
Route::match(['put' , 'patch'],'tag/{id}', function (Request $request , $id) {
    return tag::findOrFail($id)->update($request->all());
});
Route::delete('tag/{id}', function ($id){
    tag::findOrFail($id)->delete();
    return 204;
});
Route::get('user/{id}/lesson', function ($id) {
    $user=User::findOrFail($id)->lessons;
    return $user ;
});
Route::get('lesson/{id}/tags',function($id){
    $les = Lesson::findOrFail($id)->tags;
    return $les;
});

});
