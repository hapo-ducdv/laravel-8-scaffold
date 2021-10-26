<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramController;

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

Route::resource('courses', CourseController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/courses/{course}/join', [CourseController::class, 'join'])->name('courses.join');
    Route::get('/courses/{course}/leave', [CourseController::class, 'leave'])->name('courses.leave');

    Route::resource('courses.lessons', LessonController::class)->middleware('check.joined.course');

    Route::post('/lessons/{lesson}/programs/{program}/join', [ProgramController::class, 'store'])->name('programs.join')->middleware('check.joined.course');

    Route::resource('reviews', ReviewController::class);

    Route::resource('profile', UserController::class);
});
