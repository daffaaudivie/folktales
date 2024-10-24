<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SceneController;
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

Route::get('/stories', [StoryController::class, 'index']);
Route::get('/stories/{id}', [StoryController::class, 'show']);
Route::post('/stories', [StoryController::class, 'store']);
Route::put('/stories/{id}', [StoryController::class, 'update']);
Route::delete('/stories/{id}', [StoryController::class, 'destroy']);

Route::get('scenes', [SceneController::class, 'index']);
Route::post('scenes', [SceneController::class, 'store']);
Route::get('scenes/{id}', [SceneController::class, 'show']);
Route::post('scenes/{id}', [SceneController::class, 'update']);
Route::delete('scenes/{id}', [SceneController::class, 'destroy']);
Route::get('stories/{storyId}/scenes', [SceneController::class, 'getScenesByStory']);
