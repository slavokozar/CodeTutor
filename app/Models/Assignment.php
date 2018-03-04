<?php

namespace App\Models;

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
        'group_id',
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

    public function group()
    {
        return $this->belongsTo(Group::class);
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
        return $this->hasMany('App\Models\AssignmentSolution');
    }

    public function userHasScore(){
        return true;
    }

    public function userScore()
    {
        if($this->userSolution() == null) return 0;
        return $this->userSolution()->scores()->sum('points');
    }

    public function maxScore()
    {
        return 22;
    }

    public function userHasManualScore(){
        return true;
    }

    public function userManualScore()
    {
        return 10;
    }

    public function maxManualScore()
    {
        return 10;
    }

    public function userReview()
    {
        if($this->userSolution() == null) return 0;
        return $this->userSolution()->reviews()->sum('points');
    }




    public function deadline()
    {
        $diff = abs(date("Y-m-d H:i:s") - strtotime($this->deadline_at));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours =  floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 )/ (60*60));
        $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60)/ (60));

        if($days > 0){
            return "<span>" . $days . "</span> dní <span>" . $hours . "</span> hodín";
        }else{
            return "<span>" . $hours . "</span> hodín <span>" . $minutes . "</span> minút";
        }

    }

}
