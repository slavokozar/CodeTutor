<?php

namespace App\Policies;

use App\Classes\SchoolRoles;
use App\Models\Users\Group;
use App\Models\Users\User;
use App\Services\Users\Schools\UserSchoolService;
use Facades\App\Services\Users\Groups\UserGroupService;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
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

    public function view(User $userObj, Group $groupObj)
    {
        if($groupObj->is_public){
            return true;
        }

        if(UserGroupService::isAttached($userObj, $groupObj)){
            return true;
        }else{
            $schoolObj = $groupObj->school;

            if($schoolObj === null){
                return false;
            }

            return UserSchoolService::isAttached($userObj, $schoolObj, [SchoolRoles::ADMIN, SchoolRoles::TEACHER]);
        }
    }

    public function update(User $userObj, Group $groupObj)
    {
        if(UserGroupService::isAttached($userObj, $groupObj, GroupRoles::TEACHER)){
            return true;
        }else{
            $schoolObj = $groupObj->school;

            if($schoolObj === null){
                return false;
            }

            return UserSchoolService::isAttached($userObj, $schoolObj, SchoolRoles::ADMIN);
        }
    }
}
