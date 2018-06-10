<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17/09/2017
 * Time: 19:54
 */

namespace App\Services\Users;

use App\Classes\GroupRoles;
use App\Classes\SchoolRoles;
use App\Models\Users\User;

use Facades\App\Services\Users\UserEmailService as UserEmailServiceFacade;
use Illuminate\Support\Facades\Response;

class UserService
{
    public function all()
    {

        //todo scope

        return User::all();
    }

    public function paginate()
    {
        return User::paginate(10);
    }

    public function getOrFail($code)
    {
        $userObj = $this->get($code);

        if ($userObj == null) {
            $this->fail($code);
        } else {
            return $userObj;
        }
    }

    private function get($code)
    {
        return User::where('code', $code)->first();
    }

    public function findOrFail($id)
    {
        $userObj = User::find($id);

        if ($userObj == null) {
            $this->fail($id);
        } else {
            return $userObj;
        }
    }

    private function fail($code)
    {
        Response::make('User ' . $code . 'not found!', 404)->throwResponse();
    }


    public function blank()
    {
        return new User();
    }


    public function create($data)
    {
        $data['code'] = uniqid();
        $userObj = User::create($data);

        return $userObj;
    }


    public function update($userObj, $data)
    {
        $userObj->title = $data['title'];
        $userObj->name = $data['name'];
        $userObj->surname = $data['surname'];

        $userObj->birthdate = $data['birthdate'];

        $userObj->save();

        if ($userObj->email != $data['email']) {
            $userObj = UserEmailServiceFacade::update($userObj, $data['email']);
        }

        return $userObj;
    }

    public function destroy($userObj)
    {
        $userObj->delete();

        //todo notification
    }


    public function pathTemp($userObj){
        return storage_path('temp/' . $userObj->code);
    }


    public function managedGroups($userObj)
    {
        $publicGroups = $userObj->groups()->whereNull('school_id')
            ->wherePivotIn('role', [GroupRoles::teacher, GroupRoles::admin])
            ->get();

        $managedGroups = [
            'public_groups' => $publicGroups,
            'schools' => []
        ];

        foreach ($userObj->schools as $schoolObj) {
            $groups = $userObj->groups()->where('school_id', $schoolObj->id)
                ->wherePivotIn('role', [GroupRoles::teacher, GroupRoles::admin])
                ->get();

            if (count($groups) > 0) {
                $managedGroups['schools'][] = [
                    'school' => $schoolObj,
                    'groups' => $groups
                ];
            }
        }

        return $managedGroups;
    }

}