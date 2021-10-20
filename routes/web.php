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

Route::get('/courses', [CourseController::class, 'index'])->name('courses');

Route::get('/course/{id}', [CourseController::class, 'show'])->name('course_detail');

Route::middleware(['auth'])->group(function () {
    Route::prefix('course')->group(function () {
        Route::get('/{id}/join', [CourseController::class, 'join'])->name('join_course');
        Route::get('/{id}/leave', [CourseController::class, 'leave'])->name('leave_course');
        Route::get('/{id}/lesson/{lesson}', [LessonController::class, 'show'])->name('lesson_detail')->middleware('check.joined.course');
        Route::get('/lesson/{lesson}/program/{program}', [ProgramController::class, 'show'])->name('program')->middleware('check.joined.course');
    });

    Route::post('/review', [ReviewController::class, 'store'])->name('review_course');

    Route::get('/profile', [UserController::class, 'show'])->name('profile');

    Route::post('/update-profile', [UserController::class, 'update'])->name('update_profile');
});
