<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function show(Course $course, $lesson)
    {
        $lesson = Lesson::find($lesson);
        $courses = Course::randomCourses(config('app.paginate_other_courses'))->get();
        $reviews = $lesson->reviews()->where('type', Review::TYPE_LESSON)->paginate(config('app.paginate_reviews'));

        $lesson->users()->sync([Auth::user()->id ?? null]);

        return view('courses.lesson.show', compact('course', 'courses', 'lesson', 'reviews'));
    }
}
