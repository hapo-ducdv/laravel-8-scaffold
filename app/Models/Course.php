<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'courses';

    const STATUS_NOT_ACTIVATE = 0;
    const STATUS_ACTIVATE = 1;

    protected $fillable = [
        'name',
        'desc',
        'price',
        'status',
        'time',
        'teacher_id',
        'program',
    ];

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function teachers()
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tags');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'course_users');
    }

    public function scopeSearch($query)
    {
        //Keyword
        if ($keySearch = request()->key_search) {
            $query = $query->where('name', 'LIKE', '%'.$keySearch.'%')->orWhere('desc', 'LIKE', '%'.$keySearch.'%');
        }

        //Tags
        if ($tags = request()->tags) {
            $query->whereHas('tags', function ($subquery) use ($tags) {
                $subquery->where('tag_id', $tags);
            });
        }

        //Number lessons
        if ($numberLessons = request()->number_lessons) {
            if ($numberLessons == 'asc') {
                $query->withCount([
                    'lessons as lessons_count' => function ($subquery) {
                        $subquery->groupBy('course_id');
                    }
                ])->orderBy('lessons_count', 'ASC');
            }

            if ($numberLessons == 'desc') {
                $query->withCount([
                    'lessons as lessons_count' => function ($subquery) {
                        $subquery->groupBy('course_id');
                    }
                ])->orderBy('lessons_count', 'DESC');
            }
        }

        //Study time
        if ($studyTime = request()->study_time) {
            if ($studyTime == 'asc') {
                $query = $query->orderBy('time', 'ASC');
            }

            if ($studyTime == 'desc') {
                $query = $query->orderBy('time', 'DESC');
            }
        }

        //Number learners
        if ($numberLearners = request()->number_learners) {
            if ($numberLearners == 'asc') {
                $query->withCount([
                    'users as users_count' => function ($subquery) {
                        $subquery->groupBy('course_id');
                    }
                ])->orderBy('users_count', 'ASC');
            }

            if ($numberLearners == 'desc') {
                $query->withCount([
                    'users as users_count' => function ($subquery) {
                        $subquery->groupBy('course_id');
                    }
                ])->orderBy('users_count', 'DESC');
            }
        }

        //Teacher
        if ($teacher = request()->teacher) {
            $query = $query->where('teacher_id', $teacher);
        }

        //Status
        if ($status = request()->status) {
            if ($status == 'newest') {
                $query = $query->orderBy('id', 'ASC');
            }

            if ($status == 'oldest') {
                $query = $query->orderBy('id', 'DESC');
            }
        }

        return $query;
    }
}
