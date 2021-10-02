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

    public function scopeSearch($query, $data)
    {
        //Keyword
        if (isset($data['keyword'])) {
            $keyword = $data['keyword'];
            $query = $query->where('name', 'LIKE', '%' . $keyword . '%')->orWhere('desc', 'LIKE', '%' . $keyword . '%');
        }

        //Tags
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            $query->whereHas('tags', function ($subquery) use ($tags) {
                $subquery->whereIn('tag_id', $tags);
            });
        }

        //Number lessons
        if (isset($data['number_lessons'])) {
            $numberLessons = $data['number_lessons'];
            $query = $query->withCount([
                'lessons as lessons_count' => function ($subquery) {
                    $subquery->groupBy('course_id');
                }
            ])->orderBy('lessons_count', $numberLessons);
        }

        //Study time
        if (isset($data['study_time'])) {
            $studyTime = $data['study_time'];
            $query = $query->orderBy('time', $studyTime);
        }

        //Number learners
        if (isset($data['number_learners'])) {
            $numberLearners = $data['number_learners'];
            $query = $query->withCount([
                'users as users_count' => function ($subquery) {
                    $subquery->groupBy('course_id');
                }
            ])->orderBy('users_count', $numberLearners);
        }

        //Teacher
        if (isset($data['teacher'])) {
            $teachers = $data['teacher'];
            $query->whereHas('teachers', function ($subquery) use ($teachers) {
                $subquery->whereIn('id', $teachers);
            });
        }

        //Status
        if (isset($data['status']) && $data['status'] == config('app.oldest')) {
            $query = $query->orderBy('id', config('app.ascending'));
        } else {
            $query = $query->orderBy('id', config('app.descending'));
        }

        return $query;
    }
}
