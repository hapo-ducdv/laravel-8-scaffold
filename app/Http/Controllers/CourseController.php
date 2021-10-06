<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    public function show(Request $request, $id)
    {
        $course = Course::find($id);
        $lessons = $course->lessons()->where('name', 'LIKE', '%' . $request['keyword'] . '%')->paginate(config('app.paginate_courses_tab_lessons'));
        $courses = Course::randomCourses(config('app.paginate_other_courses'))->get();
        $reviews = $course->reviews()->where('type', 'course')->paginate(config('app.paginate_reviews'));

        return view('courses.show', compact('course', 'courses', 'lessons', 'reviews'));
    }

    public function join($id)
    {
        if (isset(Auth::user()->id)) {
            $course = Course::find($id);

            if ($course->join == config('app.join')) {
                $course->users()->attach([Auth::user()->id]);

                return back()->with('success', 'Join the successful course');
            } else {
                return back()->with('error', 'You taken this course');
            }
        } else {
            return back()->with('error', 'You must be logged in to do this');
        }
    }

    public function leave($id)
    {
        if (isset(Auth::user()->id)) {
            $course = Course::find($id);

            if ($course->join > config('app.join')) {
                $course->users()->detach([Auth::user()->id]);

                return redirect()->route('course_detail', $id)->with('success', 'Leave this course successfully');
            } else {
                return back()->with('error', 'You need to take this course first');
            }
        } else {
            return back()->with('error', 'You must be logged in to do this');
        }
    }
}
