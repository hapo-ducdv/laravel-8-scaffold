<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseUserController;
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
    Route::resource('course-users', CourseUserController::class)->only(['store', 'destroy']);

    Route::resource('courses.lessons', LessonController::class)->only(['show'])->middleware('check.joined.course');

    Route::post('/programs/join', [ProgramController::class, 'join'])->name('programs.join');

    Route::resource('reviews', ReviewController::class)->only(['store']);

    Route::resource('user', UserController::class)->only(['show', 'update']);
});

Route::prefix('auth')->group(function () {
    Route::get('/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/google/callback', [GoogleController::class, 'handleGoogleCallback']);

    Route::get('/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
});
