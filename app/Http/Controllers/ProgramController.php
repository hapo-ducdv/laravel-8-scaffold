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
        $program = Program::find($request['programId']);
        $program->users()->sync(['user_id' => Auth::user()->id ?? null]);
        $progress = $program->lesson->progress;

        return response()->json([
            'progress' => $progress
        ]);
    }
}
