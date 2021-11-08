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

    public function getIsJoinedAttribute()
    {
        return $this->users->contains(Auth::user()->id ?? null);
    }

    public function programs()
    {
        return $this->hasMany(Program::class, 'lesson_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'target_id');
    }

    public function getNumberReviewAttribute()
    {
        return $this->reviews()->where('type', Review::TYPE_LESSON)->count();
    }

    public function getTotalRateAttribute()
    {
        return round($this->reviews()->where('type', Review::TYPE_LESSON)->avg('rate'));
    }

    public function getRatingsAttribute()
    {
        return $this->reviews()->where('type', Review::TYPE_LESSON)->selectRaw('count(*) as total, rate')->groupBy('rate')->get();
    }

    public function getStarRatingAttribute()
    {
        $starRatings = [0, 0, 0, 0, 0];
        foreach ($this->ratings as $rating) {
            $starRatings[$rating->rate - config('app.one_stars')] = $rating->total;
        }

        return $starRatings;
    }
    public function getTotalJoinedAttribute()
    {
        return Program::numberJoinedProcess($this->id);
    }

    public function getTotalProgramAttribute()
    {
        return $this->programs()->count() == config('app.process_min') ? config('app.process_auto') : $this->programs()->count();
    }

    public function getProgressAttribute()
    {
        return round($this->totalJoined / $this->totalProgram * config('app.process_max'), config('app.process_auto'));
    }

    public function scopeNumberJoinedProcess($query, $courseId)
    {
        return $query->where('course_id', $courseId)->whereHas('users', function ($subquery) {
            $subquery->where('user_id', Auth::user()->id ?? null);
        })->count();
    }
}
