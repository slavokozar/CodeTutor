<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:42
 */

namespace App\Http\Controllers\Users\Groups;

use App\Classes\GroupRoles;
use App\Http\Controllers\Controller;

use Facades\App\Services\Users\Groups\GroupService;
use Facades\App\Services\Users\Groups\TeacherService;
use Facades\App\Services\Users\Groups\UserGroupService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group)
    {
        $groupObj = GroupService::getOrFail($group);
        $users = TeacherService::paginate($groupObj);

        return view('users.groups.teachers.index', compact(['groupObj','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group)
    {
        $groupObj = GroupService::getOrFail($group);

        $users = TeacherService::potential($groupObj);

        return view('users.groups.teachers.create', compact(['groupObj', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $group)
    {
        $groupObj = GroupService::getOrFail($group);

        UserGroupService::attachIds($request->input('users'), $groupObj, GroupRoles::teacher);

        return redirect(action('Users\Groups\TeacherController@index', [$groupObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($group, $user)
    {
        $groupObj = GroupService::getOrFail($group);
        $userObj = TeacherService::getOrFail($groupObj, $user);

        $groups = $userObj->groups()->whereHas('school', function ($query) use ($groupObj) {
            $query->where('id', $groupObj->id);
        })->get();

        return view('users.groups.teachers.show', compact(['groupObj', 'userObj', 'groups']));
    }

    /**
     * Show modal fo destroy confirmation
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteModal($group, $user)
    {
        $groupObj = GroupService::getOrFail($group);
        $userObj = TeacherService::getOrFail($groupObj, $user);

        return view('users.groups.teachers.delete', compact(['groupObj', 'userObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($group, $user)
    {
        $groupObj = GroupService::getOrFail($group);
        $userObj = TeacherService::getOrFail($groupObj, $user);

        UserGroupService::detach($userObj, $groupObj);

        return redirect(action('Users\Groups\TeacherController@index', [$groupObj->code]));
    }
}