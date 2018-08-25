<?php

namespace App\Models\Assignments;


use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public $table = 'assignment_solution_scores';

    protected $fillable = [
        'solution_id'
    ];

    public function solution(){
        return $this->belongsTo(Solution::class, 'solution_id');
    }
}
