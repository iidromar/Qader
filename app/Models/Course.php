<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_date',
        'description',
        'creator',
        'category',
        'price',
    ];

 public function creator(){
     return $this->belongsTo(User::class);
 }
public function requested(){
     return $this->belongsToMany(User::class,'course_requested', 'course_id', 'admin_id');
}
public function taken(){
        return $this->belongsToMany(User::class, 'course_taken_by', 'course_id', 'employee_id');
    }
    public static function getPossibleCategories(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM courses WHERE Field = "category"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
    public function courseQuestions()
    {
        return $this->hasMany(Question::class);
    }
    public function courseQuizzes()
    {
        return $this->hasMany(quiz::class);
    }
}
