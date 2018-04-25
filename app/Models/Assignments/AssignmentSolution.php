<?php

namespace App\Models\Assignments;


use Illuminate\Database\Eloquent\Model;

class AssignmentSolution extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'filename',
        'lang'
    ];

    public function score(){

    }

    public function icon(){
        if($this->filename != "" && pathinfo($this->filename)['extension'] == 'zip'){
            return '<i class="fa fa-file-archive-o"></i>';
        }else{
            return '<i class="fa fa-file-o"></i>';
        }
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function assignment(){
        return $this->belongsTo('App\Models\Assignment', 'assignment_id');
    }

    public function scores(){
        return $this->hasMany('App\Models\AssignmentSolutionScore', 'solution_id');
    }

    public function reviews(){
        return $this->hasMany('App\Models\AssignmentSolutionReview', 'solution_id');
    }
}
