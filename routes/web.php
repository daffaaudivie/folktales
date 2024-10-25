<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\MultipleController;
use App\Http\Controllers\TrueFalseController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\DashboardController;

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

// Redirect root URL to login if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Story Routes
    Route::resource('story', StoryController::class);
    Route::get('/story/{story_id}', [StoryController::class, 'show'])->name('story.detail_story'); // Story detail
    Route::get('/create_story', [StoryController::class, 'create'])->name('story.create_story');
    Route::get('/story/{story_id}/scene/create', [StoryController::class, 'createScene'])->name('scene.create');
    Route::post('/story/{story_id}/scene', [StoryController::class, 'storeScene'])->name('scene.store');

    // Scene Routes
    Route::resource('scene', SceneController::class);
    Route::get('/scene/{scene_id}', [SceneController::class, 'show'])->name('scene.show'); 
    Route::get('/create_scene', [SceneController::class, 'create'])->name('scene.create_scene'); 

    // Multiple Choice Routes
    Route::resource('multiple', MultipleController::class);
    Route::get('/create_multiple', [MultipleController::class, 'create'])->name('multiple.create');
    Route::post('/create_multiple', [MultipleController::class, 'store'])->name('multiple.store');

    // True/False Routes
    Route::resource('truefalse', TrueFalseController::class);
    Route::get('/story/{story_id}/truefalse', [TrueFalseController::class, 'detail'])->name('truefalse.detail');
    Route::get('/create_tf', [TrueFalseController::class, 'create'])->name('truefalse.create');
    Route::post('/create_tf', [TrueFalseController::class, 'store'])->name('truefalse.store');
    Route::get('/story/{story_id}', [TrueFalseController::class, 'showAssessmentDetail'])->name('story.detail');

    // Matching Routes
    Route::resource('matching', MatchingController::class);
    Route::get('/create_matching', [MatchingController::class, 'create'])->name('matching.create');
    Route::post('/create_matching', [MatchingController::class, 'store'])->name('matching.store');
    Route::get('/matching/edit/{id_asses}', [MatchingController::class, 'edit'])->name('matching.edit');
    Route::put('/matching/{id_asses}', [MatchingController::class, 'update'])->name('matching.update');
});

require __DIR__.'/auth.php';
