<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_LESSON = 1;
    const TYPE_PDF = 2;
    const TYPE_VIDEO = 3;

    protected $table = 'programs';

    protected $fillable = [
        'lesson_id',
        'name',
        'path',
        'type',
    ];
}
