<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lessons';

    protected $fillable = [
        'name',
        'desc',
        'course_id',
        'teacher_id',
        'time',
    ];

    public function teachers()
    {
        return $this->hasOne(Teacher::class, 'teacher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_users');
    }

    public function getJoinAttribute()
    {
        $id = null;
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
        }

        return $this->users()->where('user_id', $id)->count();
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'lesson_id');
    }

    public function getNumberProgramAttribute()
    {
        return $this->programs()->count();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'target_id');
    }

    public function getNumberReviewAttribute()
    {
        return $this->reviews()->where('type', 'lesson')->count();
    }

    public function getTotalRateAttribute()
    {
        return round($this->reviews()->where('type', 'lesson')->avg('rate'));
    }

    public function getFiveStarRatingAttribute()
    {
        return $this->reviews()->where('type', 'lesson')->where('rate', config('app.max_stars'))->count();
    }

    public function getFourStarRatingAttribute()
    {
        return $this->reviews()->where('type', 'lesson')->where('rate', config('app.four_stars'))->count();
    }

    public function getThreeStarRatingAttribute()
    {
        return $this->reviews()->where('type', 'lesson')->where('rate', config('app.three_stars'))->count();
    }

    public function getTwoStarRatingAttribute()
    {
        return $this->reviews()->where('type', 'lesson')->where('rate', config('app.two_stars'))->count();
    }

    public function getOneStarRatingAttribute()
    {
        return $this->reviews()->where('type', 'lesson')->where('rate', config('app.one_stars'))->count();
    }

    public function scopeNumberJoinedProcess($query, $courseId)
    {
        $id = null;
        if (isset(Auth::user()->id)) {
            $id = Auth::user()->id;
        }

        return $query->where('course_id', $courseId)->whereHas('users', function ($subquery) use ($id) {
            $subquery->where('user_id', $id);
        })->count();
    }
}
