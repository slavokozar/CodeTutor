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
    public function attach($userObj, $schoolObj, $role = SchoolRoles::student){
        $userObj->schools()->attach($schoolObj, ['role' => $role]);

        //todo notification
    }

    public function detach($userObj, $schoolObj){
        $userObj->schools()->detach($schoolObj);

        //todo notification
    }

}