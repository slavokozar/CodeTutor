<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 3.6.18
 * Time: 23:03
 */

namespace App\Models\Assignments;


use Illuminate\Database\Eloquent\Model;

class SolutionFile extends Model
{
    protected $table = 'assignment_solution_files';

    protected $fillable = [
        'solution_id',
        'code',
        'dirname',
        'filename',
        'ext'
    ];

    public function comments(){
        return $this->hasMany(SolutionComment::class, 'file_id');
    }
}