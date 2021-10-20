<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function show($lessonId, $programId)
    {
        $program = Program::find($programId);

        $program->users()->sync([Auth::user()->id]);

        return redirect()->to($program->path);
    }
}
