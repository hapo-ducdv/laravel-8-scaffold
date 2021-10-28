<?php

namespace App\Http\Middleware;

use App\Models\Lesson;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckJoinedCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $lesson = Lesson::find($request['lesson']);

        if ($lesson->courses->users->contains(Auth::user()->id)) {
            return $next($request);
        } else {
            return redirect()->route('course_detail', $lesson->courses->id)->with('error', 'Join this course first');
        }
    }
}
