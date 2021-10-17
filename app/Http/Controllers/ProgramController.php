<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function show($id)
    {
        if (isset(Auth::user()->id)) {
            $program = Program::find($id);

            $program->users()->attach([Auth::user()->id]);

            return redirect()->to($program->path);
        }
    }
}
