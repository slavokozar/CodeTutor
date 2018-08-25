<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20.3.2018
 * Time: 23:13
 */

namespace App\Services\Users\Groups;

use App\Classes\GroupRoles;
use App\Notifications\addedToGroupAsStudentNotification;
use App\Notifications\addedToGroupAsTeacherNotification;
use App\Notifications\removedFromGroupAsStudentNotification;
use Facades\App\Services\Users\UserService;

class UserGroupService
{

    public function attach($userObj, $groupObj, $role = GroupRoles::student)
    {
        $userObj->groups()->attach($groupObj, ['role' => $role]);

        if($role == GroupRoles::student)
            $userObj->notify( new addedToGroupAsStudentNotification($groupObj));
        elseif($role == GroupRoles::teacher)
            $userObj->notify( new addedToGroupAsTeacherNotification($groupObj));

        flash(trans('users.students.add-notification', ['name' => $userObj->name, 'group' => $groupObj->name]))->success();
    }

    public function attachIds($users, $groupObj, $role = GroupRoles::student)
    {
        foreach ($users as $user) {
            $this->attach(UserService::findOrFail($user), $groupObj, $role);
        }
    }


    public function detach($userObj, $groupObj)
    {
        $userObj->groups()->detach($groupObj);

        $userObj->notify( new removedFromGroupAsStudentNotification($groupObj));


        flash(trans('users.students.remove-notification', ['name' => $userObj->name, 'group' => $groupObj->name]))->success();
    }

    public function detachIds($users, $groupObj, $role = GroupRoles::student)
    {
        foreach ($users as $user) {
            $this->detach(UserService::findOrFail($user), $groupObj, $role);
        }
    }

}