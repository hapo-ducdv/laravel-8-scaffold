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
        return $this->reviews()->where('type', 'lesson')->count();
    }

    public function getTotalRateAttribute()
    {
        return round($this->reviews()->where('type', 'lesson')->avg('rate'));
    }

    public function getStarRatingAttribute()
    {
        $starRatingTotal = [config('app.min_stars'), config('app.min_stars'), config('app.min_stars'), config('app.min_stars'), config('app.min_stars')];

        $starRating = $this->reviews()->where('type', 'lesson')->selectRaw('count(*) as total, rate')->groupBy('rate')->get();

        foreach ($starRating as $rating) {
            for ($i = config('app.i'); $i < config('app.max_stars'); $i++) {
                if ($rating->rate == config('app.max_stars') - $i) {
                    $starRatingTotal[$i] = $rating->total;
                }
            }
        }

        return $starRatingTotal;
    }

    public function getProgressAttribute()
    {
        $numberJoined = Program::numberJoinedProcess($this->id);
        $numberProgram = $this->programs()->count() == config('app.process_min') ? config('app.process_auto') : $this->programs()->count();
        $progress = round($numberJoined / $numberProgram * config('app.process_max'), config('app.process_auto'));

        return $progress == config('app.process_min') ? config('app.process_min') : $progress;
    }

    public function scopeNumberJoinedProcess($query, $courseId)
    {
        return $query->where('course_id', $courseId)->whereHas('users', function ($subquery) {
            $subquery->where('user_id', Auth::user()->id ?? null);
        })->count();
    }
}
