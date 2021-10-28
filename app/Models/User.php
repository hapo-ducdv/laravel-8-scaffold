<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'username',
        'birthday',
        'address',
        'avatar',
        'phone',
        'intro',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_users');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    public function getBirthdayFormatAttribute()
    {
        return Carbon::parse($this['birthday'])->format('d/m/Y');
    }

    public function updateAvatar($data, $user)
    {
        $data->file('avatar')->store('/public/users');
        $path = $data->file('avatar')->hashName();

        return $user->update(['avatar' => '/storage/users/' . $path]);
    }

    public function updateInfo($data, $user)
    {
        return $user->update([
            'fullname' => $data['update_fullname'],
            'birthday' => $data['update_birthday'],
            'phone' => $data['update_phone'],
            'address' => $data['update_address'],
            'intro' => $data['update_intro']
        ]);
    }
}
