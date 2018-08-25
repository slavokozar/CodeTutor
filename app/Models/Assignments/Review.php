<?php

namespace App\Models\Assignments;


use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $table = 'assignment_solution_reviews';

    protected $fillable = [
        'solution_id'
    ];

    public function solution(){
        return $this->belongsTo(Solution::class, 'solution_id');
    }
}
