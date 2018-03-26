<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.3.18
 * Time: 1:05
 */

namespace App\Services\Users\Groups;

use App\Classes\SchoolRoles;

use App\Models\Users\User;
use Illuminate\Support\Facades\Response;

use Facades\App\Services\Users\UserService as UserServiceFacade;
use Facades\App\Services\Users\Groups\UserGroupService as UserGroupServiceFacade;
use Facades\App\Services\Users\Schools\UserSchoolService as UserSchoolServiceFacade;

class TeacherService
{
    public function all($schoolObj)
    {
        return $schoolObj->teachers;
    }

    public function paginate($schoolObj)
    {
        return $schoolObj->teachers()->paginate(10);
    }

    public function getOrFail($schoolObj, $code)
    {
        $userObj = $this->get($schoolObj, $code);

        if ($userObj == null) {
            $this->fail($schoolObj, $code);
        } else {
            return $userObj;
        }
    }

    private function get($schoolObj, $code)
    {
        return $schoolObj->teachers()->where('code', $code)->first();
    }

    private function fail($schoolObj, $code)
    {
        $message = trans('users.users.not-found', ['code' => $code]);
        $action = action('Users\Schools\TeacherController@index', [$schoolObj->code]);
        $label = trans('users.teachers.link');
        Response::view('users.users.not-found',compact('code', 'action', 'label', 'message'))->throwResponse();
    }

    public function potential($groupObj){
        if($groupObj->school != null){

            return $groupObj->school->students()->whereDoesntHave('groups', function($query) use ($groupObj) {
                $query->where('user_groups.id', $groupObj->id);
            })->get();

        }else{

            return User::whereDoesntHave('groups', function($query) use ($groupObj){
                $query->where('user_groups.id', $groupObj->id);
            })->get();

        }
    }
}