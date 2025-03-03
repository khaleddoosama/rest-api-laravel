<?php

use App\Http\Controllers\LessonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');

Route::post('login', [LoginController::class, 'login']);

Route::group(['prefix' => 'v1'], function () {

    Route::apiResource('lesson', LessonController::class);

    Route::apiResource('user', UserController::class);

    Route::apiResource('tag', TagController::class);

    Route::get('user/{id}/lesson', [RelationController::class, 'UserLessons']);
    Route::get('lesson/{id}/tag', [RelationController::class, 'TagLessons']);
    Route::get('tag/{id}/lesson', [RelationController::class, 'LessonTags']);

    Route::any('oldlesson', function () {
        $massage = "this is not updated api";
        return Response::json($massage, 404);
    });
    // Route::redirect('oldlesson','lesson');
});