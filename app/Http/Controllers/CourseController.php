<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use App\Models\Tag;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        $tags = Tag::all();
        $teachers = Teacher::all();
        $courses = Course::search($data)->paginate(config('app.paginate_courses'));

        return view('courses.index', compact('tags', 'teachers', 'courses'));
    }

    public function show(Request $request, Course $course)
    {
        $lessons = $course->lessons()->where('name', 'LIKE', '%' . $request['keyword'] . '%')->paginate(config('app.paginate_courses_tab_lessons'));
        $randomCourses = Course::randomCourses(config('app.paginate_other_courses'))->get();
        $reviews = $course->reviews()->where('type', Review::TYPE_COURSE)->paginate(config('app.paginate_reviews'));

        return view('courses.show', compact('course', 'randomCourses', 'lessons', 'reviews'));
    }
}
