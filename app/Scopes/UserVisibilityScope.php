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

        // admin vidi vsetko - netreba ziadne constrainy
        if (!$userObj->isAdmin()) {

            // skoly, v ktorych ma prihlaseny uzivatel rolu spravcu, alebo ucitela
            $schools = $userObj->schools()->wherePivotIn('role', [SchoolRoles::admin, SchoolRoles::teacher])->pluck('schools.id');

            // skupiny, v ktorych ma prihlaseny uzivatel rolu ucitela
            $groups = $userObj->groups()->wherePivot('role', GroupRoles::teacher)->pluck('user_groups.id');

            $builder->where(function($query) use ($schools, $groups){
                if($schools->count() > 0)

                    $query->whereHas('schools', function ($query) use ($schools) {
                        $query->where('schools.id', $schools);
                    });

                if($groups->count() > 0)
                    $query->orWhereHas('groups', function ($query) use ($groups) {
                        $query->whereIn('user_groups.id', $groups);
                    });

            });
        }
    }
}