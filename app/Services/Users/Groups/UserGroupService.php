<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20.3.2018
 * Time: 23:13
 */

namespace App\Services\Users\Groups;

use App\Classes\GroupRoles;
use App\Models\Users\User;
use App\Notifications\addedToGroupAsStudentNotification;
use App\Notifications\addedToGroupAsTeacherNotification;
use App\Notifications\removedFromGroupAsStudentNotification;
use App\Notifications\removedFromGroupAsTeacherNotification;
use Facades\App\Services\Users\UserService;

class UserGroupService
{

    public function isAttached($userObj, $groupObj, $role = null)
    {
        $groups = $userObj->groups()->where('id', $groupObj->id);
        if(is_array($role)){
            $groups->wherePivotIn('role', $role);
        } elseif($role !== null){
            $groups->wherePivot('role', $role);
        }
        return $groups->count() > 0;
    }

    public function attach($userObj, $groupObj, $role = GroupRoles::STUDENT, $notification = true)
    {
        $userObj->groups()->attach($groupObj, ['role' => $role]);

        if($role == GroupRoles::STUDENT)
            $userObj->notify( new addedToGroupAsStudentNotification($groupObj));
            if($notification)
                flash(trans_choice('users.students.add-notification', 1, ['name' => $userObj->name, 'group' => $groupObj->name]))->success();
        elseif($role == GroupRoles::TEACHER)
            $userObj->notify( new addedToGroupAsTeacherNotification($groupObj));
            if($notification)
                flash(trans_choice('users.teachers.add-notification', 1, ['name' => $userObj->name, 'group' => $groupObj->name]))->success();
    }

    public function attachIds($users, $groupObj, $role = GroupRoles::STUDENT)
    {
        $users = User::whereIn('id', $users)->get();

        foreach($users as $userObj){
            $this->attach($userObj, $groupObj, $role, false);
        }

        $names = $users->map(function ($item, $key) {
            return $item->fullName();
        });

        $names = join(', ', $names->toArray());

        flash(trans_choice('users.students.add-notification', $users->count(), ['name' => $names, 'group' => $groupObj->name]))->success();
    }


    public function detach($userObj, $groupObj, $notification = true)
    {
        $role = $userObj->groups()->find($groupObj->id)->pivot->role;

        $userObj->groups()->detach($groupObj);

        if($role == GroupRoles::STUDENT)
            $userObj->notify( new removedFromGroupAsStudentNotification($groupObj));
            if($notification)
                flash(trans_choice('users.students.remove-notification', 1, ['name' => $userObj->name, 'group' => $groupObj->name]))->success();

        elseif($role == GroupRoles::TEACHER)
            $userObj->notify( new removedFromGroupAsTeacherNotification($groupObj));
            if($notification)
                flash(trans_choice('users.teachers.remove-notification', 1, ['name' => $userObj->name, 'group' => $groupObj->name]))->success();

    }

    public function detachIds($users, $groupObj, $role = GroupRoles::STUDENT)
    {
        $users = User::whereIn('id', $users)->get();

        foreach($users as $userObj){
            $this->detach($userObj, $groupObj, false);
        }

        $names = $users->map(function ($item, $key) {
            return $item->fullName();
        });

        $names = join(', ', $names->toArray());

        flash(trans_choice('users.students.remove-notification', $users->count(), ['name' => $names, 'group' => $groupObj->name]))->success();
    }

}