<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_date',
        'description',
        'creator',
        'category',
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
}
