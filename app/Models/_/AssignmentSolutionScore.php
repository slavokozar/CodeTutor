<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSolutionScore extends Model
{
    protected $table = 'assignment_solution_scores';

    protected $fillable = [
        'solution_id',
        'task',
        'test',
        'points'
    ];

    public function solution(){
        return $this->belongsTo('App\Models\AssignmentSolution', 'solution_id');
    }

}
