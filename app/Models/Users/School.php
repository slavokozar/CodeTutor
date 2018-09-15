<?php

namespace App\Models\Users;

use App\Classes\SchoolRoles;
use App\Models\Articles\Article;
use App\Models\Assignments\Assignment;
use App\Models\Files\File;
use App\Models\Links\Link;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\School
 *
 * @mixin \Eloquent
 */
class School extends Model
{
    use SoftDeletes;

    const TABLE_NAME = 'schools';

    protected $table = School::TABLE_NAME;

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
        return $this->users()->wherePivot('role',SchoolRoles::ADMIN);
    }

    public function teachers()
    {
        return $this->users()->wherePivot('role',SchoolRoles::TEACHER);
    }

    public function students()
    {
        return $this->users()->wherePivot('role', SchoolRoles::STUDENT);
    }

    public function groups(){
        return $this->hasMany(Group::class, 'school_id');
    }


    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        $userObj = Auth::user();

        // admin can see any group
        if ($userObj !== null && !$userObj->isAdmin()) {
            return $query->whereHas('users', function($query) use ($userObj){
                $query
                    ->where(User::TABLE_NAME . '.id', $userObj->id)
                    ->wherePivotIn('role', [SchoolRoles::ADMIN, SchoolRoles::TEACHER]);
            });
        }

        return $query;
    }
}
