<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function show($id, $lessonId)
    {
        if (isset(Auth::user()->id)) {
            $lesson = Lesson::find($lessonId);
            $course = Course::find($id);
            $courses = Course::randomCourses(config('app.paginate_other_courses'))->get();
            $reviews = $lesson->reviews()->where('type', 'lesson')->paginate(config('app.paginate_reviews'));

            if ($course->join > config('app.join')) {
                return view('courses.lesson.show', compact('course', 'courses', 'lesson', 'reviews'));
            } else {
                return back()->with('error', 'You need to take this course first');
            }
        } else {
            return back()->with('error', 'You must be logged in to do this');
        }
    }
}
