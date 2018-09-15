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
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class GroupVisibilityScope implements Scope
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

        // admin can see any group
        if (!$userObj->isAdmin()) {

//            $builder->where(User::TABLE_NAME . '.id', 4);

            $builder->whereHas('users', function($query) use ($userObj){
                $query->where(User::TABLE_NAME . '.id', $userObj->id);
            });
        }
    }
}