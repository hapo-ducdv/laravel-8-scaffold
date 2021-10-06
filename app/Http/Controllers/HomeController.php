<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::randomCourses(config('app.paginate_home_courses'))->get();
        $otherCourses = Course::randomCourses(config('app.paginate_home_courses'))->get();

        return view('home', compact('courses', 'otherCourses'));
    }
}
