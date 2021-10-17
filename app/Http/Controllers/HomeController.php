<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::randomCourses(config('app.paginate_home_courses'))->get();
        $otherCourses = Course::randomCourses(config('app.paginate_home_courses'))->get();
        $reviews = Review::Search()->get();
        $numberCourse = Course::count();
        $numberLesson = Lesson::count();
        $numberUser = User::count();

        return view('home', compact('courses', 'otherCourses', 'reviews', 'numberCourse', 'numberLesson', 'numberUser'));
    }
}
