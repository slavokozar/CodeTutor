<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 13.9.18
 * Time: 21:04
 */

namespace App\Scopes;

use App\Classes\GroupRoles;
use App\Classes\SchoolRoles;
use App\Models\Users\Group;
use App\Models\Users\School;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class UserVisibilityScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $userObj = Auth::user();

        // admin can see anybody
        if (Auth::check() && !$userObj->isAdmin()) {

            // schools, in which logged user has admin or teacher role
            $schools = $userObj->schools()->wherePivotIn('role', [SchoolRoles::ADMIN, SchoolRoles::TEACHER])->pluck(School::TABLE_NAME . '.id');

            // groups, in which logged user has teacher role
            $groups = $userObj->groups()->wherePivot('role', GroupRoles::TEACHER)->pluck(Group::TABLE_NAME . '.id');

            $builder->where(function($query) use ($schools, $groups){
                if($schools->count() > 0)

                    $query->whereHas('schools', function ($query) use ($schools) {
                        $query->where(School::TABLE_NAME . '.id', $schools);
                    });

                if($groups->count() > 0)
                    $query->orWhereHas('groups', function ($query) use ($groups) {
                        $query->whereIn(Group::TABLE_NAME . '.id', $groups);
                    });

            });
        }
    }
}