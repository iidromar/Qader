<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\course;
class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at' ,'course_id'];
    protected $fillable = [
        'course_id',
        'question_text',
    ];
    public function course(){
        return $this->belongsTo(course::class);
    }

    public function questionOptions(){
        return $this->hasMany(Option::class);
    }

}
