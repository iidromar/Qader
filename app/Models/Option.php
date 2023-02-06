<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at' , 'quiz_id'];
    protected $fillable = [
        'points',
        'option_text',
        'question_id',
        'quiz_id',
    ];
    public function question(){
        return $this->belongsTo(Question::class);
    }
    public function quiz(){
        return $this->belongsTo(quiz::class);
    }
}
