<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkProgress extends Model
{
    protected $fillable = [
        'state',
        'employee_id',
        'lesson_id',
        'course_id',
    ];
    use HasFactory;
}
