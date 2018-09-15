<?php

namespace App\Models\Users;

use App\Classes\GroupRoles;

use App\Models\Articles\Article;
use App\Models\Assignments\Assignment;
use App\Models\Files\File;
use App\Models\Links\Link;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Group
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]       $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Assignment[] $assignments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[]       $lecturer
 * @mixin \Eloquent
 */
class Group extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'user_groups';

    protected $table = Group::TABLE_NAME;

    protected $fillable = [
        'name',
        'code',
        'school_id',
        'is_public'
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_group_user', 'user_id', 'group_id')->withPivot(['role']);
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role',GroupRoles::TEACHER);
    }

    public function students()
    {
        return $this->users()->wherePivot('role', GroupRoles::STUDENT);
    }

    public function school(){
        return $this->belongsTo(School::class, 'school_id');
    }

    
    public function sharedArticle(){
        return $this->belongsToMany(Article::class, 'article_group_sharing', 'group_id', 'article_id');
    }

    public function sharedAssignment(){
        return $this->belongsToMany(Assignment::class, 'assignment_group_sharing', 'group_id', 'assignment_id');
    }

    public function sharedFiles(){
        return $this->belongsToMany(File::class, 'file_group_sharing', 'group_id', 'file_id');
    }

    public function sharedLinks(){
        return $this->belongsToMany(Link::class, 'link_group_sharing', 'group_id', 'link_id');
    }


}
