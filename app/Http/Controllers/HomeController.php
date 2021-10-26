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
        $reviews = Review::qualityReviews()->get();
        $totalCourse = Course::count();
        $totalLesson = Lesson::count();
        $totalUser = User::where('role', User::ROLE_USER)->count();

        return view('home', compact('courses', 'otherCourses', 'reviews', 'totalCourse', 'totalLesson', 'totalUser'));
    }
}
