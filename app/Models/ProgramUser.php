<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'program_user';

    protected $fillable = [
        'program_id',
        'user_id',
    ];
}
