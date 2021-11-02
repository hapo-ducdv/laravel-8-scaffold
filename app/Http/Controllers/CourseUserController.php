<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseUserController extends Controller
{
    public function store(Request $request)
    {
        $course = Course::findOrFail($request['course_id']);

        if (!$course->joined) {
            $course->users()->sync([Auth::user()->id ?? null]);

            return back()->with('success', 'Join the successful course');
        } else {
            return back()->with('error', 'You have already taken this course');
        }
    }

    public function destroy(Course $courseUser)
    {
        if ($courseUser->joined) {
            $courseUser->users()->detach([Auth::user()->id ?? null]);

            return redirect()->route('courses.show', $courseUser)->with('success', 'Leave this course successfully');
        } else {
            return back()->with('error', 'You have not taken this course');
        }
    }
}
