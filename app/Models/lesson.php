<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\course;
class lesson extends Model
{
    protected $fillable = [
        'descriptions',
        'names',
        'video',
        'course_id',
    ];
    public function course(){
        return $this->belongsTo(course::class);
    }
    public $uploadDirectory='/storage/instit/courses/';
    public function video() : Attribute
    {
        return Attribute::make(
            get: fn ($video) => $this->uploadDirectory. $video
        );
    }
    use HasFactory;
}
