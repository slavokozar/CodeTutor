<?php

namespace App\Policies;

use App\Classes\SchoolRoles;

use App\Models\Users\User;
use App\Models\Users\School;

use App\Services\Users\Schools\UserSchoolService;

use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $userObj, School $schoolObj)
    {
        return UserSchoolService::isAttached($userObj, $schoolObj);
    }

    public function create(User $userObj)
    {
        return false;
    }

    public function update(User $userObj, School $schoolObj)
    {
        return UserSchoolService::isAttached($userObj, $schoolObj, SchoolRoles::MANAGER);
    }

}
