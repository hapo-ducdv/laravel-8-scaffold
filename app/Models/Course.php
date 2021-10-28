<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

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
        'image',
    ];

    public function getNumberCourseAttribute()
    {
        return $this->count();
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
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

    public function getJoinAttribute()
    {
        return $this->users->contains(Auth::user()->id ?? null);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'target_id');
    }

    public function getNumberReviewAttribute()
    {
        return $this->reviews()->where('type', Review::TYPE_COURSE)->count();
    }

    public function getTotalRateAttribute()
    {
        return round($this->reviews()->where('type', Review::TYPE_COURSE)->avg('rate'));
    }

    public function getStarRatingAttribute()
    {
        $starRatings = [0, 0, 0, 0, 0];

        $ratings = $this->reviews()->where('type', Review::TYPE_COURSE)->selectRaw('count(*) as total, rate')->groupBy('rate')->get();

        foreach ($ratings as $rating) {
            $starRatings[$rating->rate - config('app.one_stars')] = $rating->total;
        }

        return $starRatings;
    }

    public function getProgressAttribute()
    {
        $numberProgram = config('app.process_min');
        $numberProgramJoined = config('app.process_min');

        $numberLesson = $this->lessons()->count();

        foreach ($this->lessons as $lesson) {
            $takeNumberProgramJoined = Program::numberJoinedProcess($lesson->id);
            $takeNumberProgram = $lesson->programs()->count();
            $numberProgram += $takeNumberProgram;
            $numberProgramJoined += $takeNumberProgramJoined;
        }

        $sumLessonProgram = ($numberLesson * $numberProgram) == 0 ? config('app.process_auto') : ($numberLesson * $numberProgram);
        $progress = round(($numberLesson * $numberProgramJoined) / $sumLessonProgram * config('app.process_max'), config('app.process_auto'));

        return $progress == config('app.process_min') ? config('app.process_min') : $progress;
    }

    public function scopeSearch($query, $data)
    {
        if (isset($data['keyword'])) {
            $query->where('name', 'LIKE', '%' . $data['keyword'] . '%')->orWhere('desc', 'LIKE', '%' . $data['keyword'] . '%');
        }

        if (isset($data['tags'])) {
            $query->whereHas('tags', function ($subquery) use ($data) {
                $subquery->whereIn('tag_id', $data['tags']);
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
            $query = $query->withSum('lessons', 'time', function ($subquery) {
                $subquery->groupBy('course_id');
            })->orderBy('lessons_sum_time', $data['study_time']);
        }

        if (isset($data['number_learners'])) {
            $query->withCount([
                'users as users_count' => function ($subquery) {
                    $subquery->groupBy('course_id');
                }
            ])->orderBy('users_count', $data['number_learners']);
        }

        if (isset($data['teacher'])) {
            $query->whereHas('teachers', function ($subquery) use ($data) {
                $subquery->whereIn('id', $data['teacher']);
            });
        }

        if (isset($data['status']) && $data['status'] == config('app.oldest')) {
            $query->orderBy('id', config('app.ascending'));
        } else {
            $query->orderBy('id', config('app.descending'));
        }

        return $query;
    }

    public function scopeRandomCourses($query, $number)
    {
        $query->inRandomOrder()->limit($number);
    }

    public function scopeRatings($query, $ratings)
    {
        if (isset($ratings)) {
            $query->withAvg('reviews', 'rate')->orderBy('reviews_avg_rate', $ratings);
        }

        return $query;
    }

    public function scopeSuggestionCourses($query)
    {
        return $query->ratings(config('app.descending'))->limit(config('app.paginate_home_courses'));
    }
}
