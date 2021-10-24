<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('courses', CourseController::class)->only(['index', 'show']);

Route::middleware(['auth'])->group(function () {
    Route::get('/courses/{course}/join', [CourseController::class, 'join'])->name('courses.join');
    Route::get('/courses/{course}/leave', [CourseController::class, 'leave'])->name('courses.leave');

    Route::resource('courses.lessons', LessonController::class)->only(['show'])->middleware('check.joined.course');

    Route::post('/programs/join', [ProgramController::class, 'join'])->name('programs.join');

    Route::resource('reviews', ReviewController::class)->only(['store']);

    Route::resource('user', UserController::class)->only(['show', 'update']);
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('login_google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login_facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
