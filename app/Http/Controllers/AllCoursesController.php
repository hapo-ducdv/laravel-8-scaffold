<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tag;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AllCoursesController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->input();

        $tags = Tag::all();
        $teachers = Teacher::all();
        $courses = Course::search($data)->paginate(config('app.paginate_courses'));

        return view('all-courses', compact(['tags', 'teachers', 'courses']));
    }
}
