<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reviews';

    const TYPE_COURSE = 'course';
    const TYPE_LESSON = 'lesson';

    protected $fillable = [
        'user_id',
        'target_id',
        'content',
        'type',
        'rate',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courses()
    {
        return $this->belongsTo(Course::class, 'target_id');
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'target_id');
    }

    public function scopeQualityReviews($query)
    {
        return $query->where('type', 'course')->where('rate', config('app.max_stars'))->limit(config('app.paginate_reviews'));
    }

    public function scopeCheckExistence($query, $id, $type)
    {
        return $query->where('user_id', Auth::user()->id ?? null)->where('target_id', $id)->where('type', $type)->count();
    }
}
