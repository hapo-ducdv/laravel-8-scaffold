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

        $process = config('app.process_max');

        foreach ($lesson->programs as $program) {
            if ($lesson->numberProgram != config('app.process_min')) {
                $process = intval($program->numberJoinedProcess($lessonId) / $lesson->numberProgram * config('app.process_max'));
            }
        }

        $lesson->users()->sync([Auth::user()->id ?? null]);

        return view('courses.lesson.show', compact('course', 'courses', 'lesson', 'reviews', 'process'));
    }
}
