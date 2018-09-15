<?php

namespace App\Models\Users;

use App\Classes\GroupRoles;

use App\Models\Articles\Article;
use App\Models\Assignments\Assignment;
use App\Models\Files\File;
use App\Models\Links\Link;
use App\Scopes\GroupVisibilityScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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

//    public function teachers()
//    {
//        return $this->users()->wherePivot('role',GroupRoles::TEACHER);
//    }
//
//    public function students()
//    {
//        return $this->users()->wherePivot('role', GroupRoles::STUDENT);
//    }

    public function school(){
        return $this->belongsTo(School::class, 'school_id');
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
                    ->wherePivot('role', SchoolRoles::TEACHER);
            });
        }

        return $query;
    }
}
