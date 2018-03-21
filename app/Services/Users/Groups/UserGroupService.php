<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20.3.2018
 * Time: 23:13
 */

namespace App\Services\Users\Groups;

use App\Classes\GroupRoles;

class UserGroupService
{
    public function attach($userObj, $groupObj, $role = GroupRoles::student){
        $userObj->groups()->attach($groupObj, ['role' => $role]);

        //todo notification
    }

    public function detach($userObj, $groupObj){
        $userObj->groups()->detach($groupObj);

        //todo notification
    }
}