<?php

namespace App\Models\Users;

use App\Classes\SchoolRoles;
use App\Models\Articles\Article;
use App\Models\Assignments\Assignment;
use App\Models\Files\File;
use App\Models\Links\Link;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\School
 *
 * @mixin \Eloquent
 */
class School extends Model
{
    use SoftDeletes;

    protected $table = 'schools';

    protected $fillable = [
        'name',
        'code',
        'address',
        'url'
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'school_user', 'user_id', 'school_id')->withPivot(['role']);
    }

    public function admins()
    {
        return $this->users()->wherePivot('role',SchoolRoles::admin);
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role',SchoolRoles::teacher);
    }

    public function students()
    {
        return $this->users()->wherePivot('role', SchoolRoles::student);
    }

    public function groups(){
        return $this->hasMany(Group::class, 'school_id');
    }


    public function sharedArticle(){
        return $this->belongsToMany(Article::class, 'article_school_sharing', 'school_id', 'article_id');
    }

    public function sharedAssignment(){
        return $this->belongsToMany(Assignment::class, 'assignment_school_sharing', 'school_id', 'assignment_id');
    }

    public function sharedFiles(){
        return $this->belongsToMany(File::class, 'file_school_sharing', 'school_id', 'file_id');
    }

    public function sharedLinks(){
        return $this->belongsToMany(Link::class, 'link_school_sharing', 'school_id', 'link_id');
    }

}
