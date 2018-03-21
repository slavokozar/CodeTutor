<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.3.18
 * Time: 1:05
 */

namespace App\Services\Users\Schools;

use App\Classes\SchoolRoles;

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

    public function blank(){
        return UserServiceFacade::blank();
    }

    public function create($schoolObj, $data){
        $userObj = UserServiceFacade::create($data);

        $schoolObj->users()->attach($userObj, ['role' => SchoolRoles::teacher]);

        return $userObj;
    }

    public function update($schoolObj, $userObj, $data){
        if(!$userObj->has('schools', $schoolObj)){
            return $this->fail($schoolObj, $userObj->code);
        }

        $userObj = UserServiceFacade::update($userObj, $data);

        return $userObj;
    }

    public function destroy($schoolObj, $userObj){

        $groups = $userObj->groups()->where('school_id',$schoolObj->id)->get();
        foreach($groups as $groupObj){
            UserGroupServiceFacade::detach($userObj, $groupObj);
        }

        UserSchoolServiceFacade::detach($userObj, $schoolObj);

        if($userObj->groups()->count() == 0 && $userObj->schools()->count() == 0){
            UserServiceFacade::destroy($userObj);
        }
    }
}