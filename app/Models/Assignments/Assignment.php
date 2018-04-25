<?php

namespace App\Models\Assignments;

use App\Models\AssignmentSolution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Assignment
 *
 * @property integer                                                           $id
 * @property integer                                                           $author_id
 * @property integer                                                           $article_id
 * @property string                                                            $input
 * @property string                                                            $tests
 * @property string                                                            $start_at
 * @property string                                                            $deadline_at
 * @property string                                                            $deleted_at
 * @property \Carbon\Carbon                                                    $created_at
 * @property \Carbon\Carbon                                                    $updated_at
 * @property-read \App\Models\User                                             $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereAuthorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereArticleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereInput($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereTests($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereStartAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereDeadlineAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Assignment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Assignment extends Model
{

    protected $fillable = [
        'author_id',
        'code',
        'is_public',
        'name',
        'description',
        'text',
        'start_at',
        'deadline_at'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function programmingLanguages()
    {
        return $this->belongsToMany(ProgrammingLanguage::class, 'assignments_programming_languages', 'assignment_id', 'programming_language_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'object_id')->where('object_type','assignment')->whereNull('reply_to_id')->orderBy('created_at', 'DESC');
    }

    public function commentType()
    {
        return 'assignment';
    }

    public function commentRoute()
    {
        return 'zadania';
    }


    public function solutions()
    {
        return $this->hasMany(AssignmentSolution::class, 'assignment_id');
    }

}
