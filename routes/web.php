<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\MultipleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//story
Route::resource('story', StoryController::class);
Route::get('/story/{story_id}', [StoryController::class, 'show'])->name('story.show');
Route::get('/create_story', [StoryController::class, 'create'])->name('story.create_story');
Route::get('/story/{story_id}', [StoryController::class, 'show'])->name('story.detail_story');
Route::get('/story/{story_id}/scene/create', [StoryController::class, 'createScene'])->name('scene.create');
Route::post('/story/{story_id}/scene', [StoryController::class, 'storeScene'])->name('scene.store');


// Scene routes
Route::resource('scene', SceneController::class);
Route::get('/scene/{scene_id}', [SceneController::class, 'show'])->name('scene.show'); 
Route::get('/create_scene', [SceneController::class, 'create'])->name('scene.create_scene'); 

Route::resource('multiple', MultipleController::class);
Route::get('/create_multiple', [MultipleController::class, 'create'])->name('multiple.create');
Route::post('/create_multiple', [MultipleController::class, 'store'])->name('multiple.store');



require __DIR__.'/auth.php';

