<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17/09/2017
 * Time: 19:54
 */

namespace App\Services\Users;

use App\Models\Users\User;

class UserService
{
    public function all(){
        return User::all();
    }


    public function attendingGroups($userObj)
    {
        return $userObj->groups()->wherePivot('lecturer', '=', 0)->get();
    }


    public function lecturingGroups($userObj)
    {
        return $userObj->groups()->wherePivot('lecturer', '=', 1)->get();
    }

}