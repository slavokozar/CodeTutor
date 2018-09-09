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

use App\Http\Requests\Users\UserRequest;
use App\Models\Users\User;
use Facades\App\Services\Users\Groups\GroupService;
use Facades\App\Services\Users\Groups\TeacherService;
use Facades\App\Services\Users\Groups\UserGroupService;
use Facades\App\Services\Users\UserService;
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
     * Show the modal for attaching resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($group)
    {
        $groupObj = GroupService::getOrFail($group);
        $users = TeacherService::potential($groupObj);

        return view('users.groups.teachers.add', compact(['groupObj', 'users']));
    }

    public function attach($group, Request $request){
        $groupObj = GroupService::getOrFail($group);

        UserGroupService::attachIds($request->input('users', []), $groupObj, GroupRoles::teacher);

        return redirect(action('Users\Groups\TeacherController@index', [$groupObj->code]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group)
    {
        $groupObj = GroupService::getOrFail($group);

        return view('users.groups.teachers.create', compact(['groupObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($group, UserRequest $request)
    {
        $groupObj = GroupService::getOrFail($group);

        $userObj = UserService::create($request->all());
        UserGroupService::attach($userObj, $groupObj, GroupRoles::teacher);

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

    public function global($group, Request $request)
    {
        $groupObj = GroupService::getOrFail($group);

        return $request->all();
        $action = $request->input('action');
        $values = $request->input('values');

        return $values;

        if ($action === 'delete') {
            UserGroupService::detachIds($values, $groupObj, GroupRoles::teacher);
        }

        return redirect()->action('User\Groups\TeacherController@index', [$groupObj->code]);
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