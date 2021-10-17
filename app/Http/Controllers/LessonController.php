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

            $process = config('app.process_max');

            foreach ($lesson->programs as $program) {
                if ($lesson->numberProgram != config('app.process_min')) {
                    $process = intval(($program->numberJoinedProcess($lessonId) + config('app.process_auto')) / ($lesson->numberProgram + config('app.process_auto')) * config('app.process_max'));
                }
            }

            if ($course->join > config('app.join')) {
                $lesson->users()->attach([Auth::user()->id]);

                return view('courses.lesson.show', compact('course', 'courses', 'lesson', 'reviews', 'process'));
            } else {
                return back()->with('error', 'You need to take this course first');
            }
        } else {
            return back()->with('error', 'You must be logged in to do this');
        }
    }
}
