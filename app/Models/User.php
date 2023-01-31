<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Couchbase\RegexpSearchQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'code',
        'position',
        'office',
        'age',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses_created(){
        return $this->hasMany(Course::class, 'creator');
    }
    public function courses_requested(){
        return $this->belongsToMany(Course::class, 'course_requested', 'admin_id', 'course_id');
    }
    public function courses_taken(){
        return $this->belongsToMany(Course::class, 'course_taken_by', 'employee_id', 'course_id');
    }
    public function company(){
        return $this->belongsTo(Company::class, 'admin');
    }
    public function userResults()
    {
        return $this->hasMany(Result::class);
    }


}
