<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lessons';

    protected $fillable = [
        'name',
        'desc',
        'video',
        'slide',
        'attachment',
        'course_id',
        'teacher_id',
    ];

    public function teachers()
    {
        return $this->hasOne(Teacher::class, 'teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
