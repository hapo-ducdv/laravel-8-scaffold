<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function show($id, $lessonId)
    {
        $lesson = Lesson::find($lessonId);
        $course = Course::find($id);
        $courses = Course::randomCourses(config('app.paginate_other_courses'))->get();
        $reviews = $lesson->reviews()->where('type', 'lesson')->paginate(config('app.paginate_reviews'));

        $lesson->users()->sync([Auth::user()->id ?? null]);

        return view('lessons.show', compact('course', 'courses', 'lesson', 'reviews'));
    }
}
