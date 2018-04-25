<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AssingmentUpload
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read \App\Models\User                                             $author
 * @property-read \App\Models\Series                                           $assignment
 * @mixin \Eloquent
 */
class AssignmentSolutionReview extends Model
{
    protected $fillable = [
        'author_id',
        'solution_id',
        'points',
        'comment'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'author_id');
    }

    public function solution()
    {
        return $this->belongsTo('App\Models\AssignmentSolution', 'solution_id');
    }

    public function score()
    {
        return $this->belongsTo('App\Models\AssignmentSolutionScore', 'score_id');
    }

}
