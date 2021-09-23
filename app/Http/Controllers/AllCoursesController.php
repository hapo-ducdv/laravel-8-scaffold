<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Tag;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AllCoursesController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        $teachers = Teacher::all();
        $courses = Course::search()->paginate(14);

        $data['tags'] = $tags;
        $data['teachers'] = $teachers;
        $data['courses'] = $courses;

        return view('all-courses', $data);
    }
}
