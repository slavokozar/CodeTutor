<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 20.3.2018
 * Time: 23:09
 */

namespace App\Services\Users\Schools;

use App\Classes\SchoolRoles;

class UserSchoolService
{

    public function isAttached($userObj, $schoolObj, $role = null)
    {
        $schools = $userObj->groups()->where('id', $schoolObj->id);
        if(is_array($role)){
            $schools->wherePivotIn('role', $role);
        }elseif($role !== null){
            $schools->wherePivot('role', $role);
        }
        return $schools->count() > 0;
    }

    public function attach($userObj, $schoolObj, $role = SchoolRoles::STUDENT){
        $userObj->schools()->attach($schoolObj, ['role' => $role]);

        //todo notification
    }

    public function detach($userObj, $schoolObj){
        $userObj->schools()->detach($schoolObj);

        //todo notification
    }

}