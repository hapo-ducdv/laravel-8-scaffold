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

    public function getNumberLessonAttribute()
    {
        return $this->lessons()->count();
    }

    public function getTotalTimeAttribute()
    {
        return $this->lessons()->sum('time');
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

    public function getNumberUserAttribute()
    {
        return $this->users()->count();
    }

    public function scopeSearch($query, $data)
    {
        if (isset($data['keyword'])) {
            $query->where('name', 'LIKE', '%' . $data['keyword'] . '%')->orWhere('desc', 'LIKE', '%' . $data['keyword'] . '%');
        }

        if (isset($data['tags'])) {
            $tags = $data['tags'];
            $query->whereHas('tags', function ($subquery) use ($tags) {
                $subquery->whereIn('tag_id', $tags);
            });
        }

        if (isset($data['number_lessons'])) {
            $query->withCount([
                'lessons as lessons_count' => function ($subquery) {
                    $subquery->groupBy('course_id');
                }
            ])->orderBy('lessons_count', $data['number_lessons']);
        }

        if (isset($data['study_time'])) {
            $query->orderBy('time', $data['study_time']);
        }

        if (isset($data['number_learners'])) {
            $query->withCount([
                'users as users_count' => function ($subquery) {
                    $subquery->groupBy('course_id');
                }
            ])->orderBy('users_count', $data['number_learners']);
        }

        if (isset($data['teacher'])) {
            $teachers = $data['teacher'];
            $query->whereHas('teachers', function ($subquery) use ($teachers) {
                $subquery->whereIn('id', $teachers);
            });
        }

        if (isset($data['status']) && $data['status'] == config('app.oldest')) {
            $query->orderBy('id', config('app.ascending'));
        } else {
            $query->orderBy('id', config('app.descending'));
        }

        return $query;
    }
}
