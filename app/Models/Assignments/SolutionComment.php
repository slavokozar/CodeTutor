<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 3.6.18
 * Time: 23:03
 */

namespace App\Models\Assignments;


use Illuminate\Database\Eloquent\Model;

class SolutionComment extends Model
{
    protected $table = 'assignment_solution_comments';

    protected $fillable = [
        'file_id',
        'line',
        'text'
    ];

    public function file(){
        return $this->belongsTo(SolutionFile::class, 'file_id');
    }
}