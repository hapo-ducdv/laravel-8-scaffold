<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function join(Request $request)
    {
        Program::find($request['programId'])->users()->sync(['user_id' => Auth::user()->id ?? null]);
        $progress = Lesson::find($request['lessonId'])->progress;

        return response()->json([
            'progress' => $progress
        ]);
    }
}
