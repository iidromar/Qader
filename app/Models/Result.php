<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $fillable = [
        'user_id',
        'course_id',
        'total_points',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function course(){
        return $this->belongsTo(course::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)->withPivot(['option_id', 'points']);
    }
}
