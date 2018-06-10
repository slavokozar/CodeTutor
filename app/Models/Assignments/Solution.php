<?php

namespace App\Models\Assignments;


use App\Models\Users\User;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $table = 'assignment_solutions';

    protected $fillable = [
        'assignment_id',
        'code',
        'user_id',
        'lang_id',
        'filename',
        'review',
        'review_points'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function score(){

    }

    public function icon(){
        if($this->filename != "" && pathinfo($this->filename)['extension'] == 'zip'){
            return '<i class="fa fa-file-archive-o"></i>';
        }else{
            return '<i class="fa fa-file-o"></i>';
        }
    }


    public function assignment(){
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function scores(){
        return $this->hasMany(Score::class, 'solution_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'solution_id');
    }

    public function files(){
        return $this->hasMany(SolutionFile::class, 'solution_id');
    }

}
