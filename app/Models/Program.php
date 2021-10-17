<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

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

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function getNumberLessonAttribute()
    {
        return $this->lesson()->count();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getJoinAttribute()
    {
        $id = null;
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
        }

        return $this->users()->where('user_id', $id)->count();
    }

    public function scopeNumberJoinedProcess($query, $lessonId)
    {
        $id = null;
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
        }

        return $query->where('lesson_id', $lessonId)->whereHas('users', function ($subquery) use ($id) {
            $subquery->where('user_id', $id);
        })->count();
    }
}
