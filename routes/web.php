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

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses');

    Route::prefix('course')->group(function () {
        Route::get('/{id}', [CourseController::class, 'show'])->name('course_detail');
        Route::get('/{id}/join', [CourseController::class, 'join'])->name('join_course');
        Route::get('/{id}/leave', [CourseController::class, 'leave'])->name('leave_course');
        Route::get('/{id}/lesson/{lesson}', [LessonController::class, 'show'])->name('lesson_detail');
    });
});
Route::get('/program/{id}', [ProgramController::class, 'show'])->name('program');
Route::post('/review', [ReviewController::class, 'store'])->name('review_course');

Route::get('/profile', [UserController::class, 'show'])->name('profile');
Route::post('/update-profile', [UserController::class, 'update'])->name('update_profile');
