<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course_id',
    ];
    public function course(){
        return $this->belongsTo(course::class, 'course_id', 'id');
    }
    public function quizquestions(){
        return $this->hasMany(question::class);
    }
}
