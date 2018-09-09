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
use Facades\App\Services\Users\Groups\StudentService;
use Facades\App\Services\Users\Groups\UserGroupService;
use Facades\App\Services\Users\UserService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($group)
    {
        $groupObj = GroupService::getOrFail($group);
        $users = StudentService::paginate($groupObj);

        return view('users.groups.students.index', compact(['groupObj','users']));
    }

    /**
    * Show the modal for attaching resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function add($group)
    {
        $groupObj = GroupService::getOrFail($group);
        $users = StudentService::potential($groupObj);

        return view('users.groups.students.add', compact(['groupObj', 'users']));
    }

    public function attach($group, Request $request){
        $groupObj = GroupService::getOrFail($group);

        UserGroupService::attachIds($request->input('users', []), $groupObj, GroupRoles::student);

        return redirect(action('Users\Groups\StudentController@index', [$groupObj->code]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group)
    {
        $groupObj = GroupService::getOrFail($group);

        return view('users.groups.students.create', compact(['groupObj']));
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

        $userObj = UserService::create($request->all());
        GroupService::attach($userObj, $groupObj, GroupRoles::student);

        return redirect(action('Users\Groups\StudentController@index', [$groupObj->code]));
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
        $userObj = StudentService::getOrFail($groupObj, $user);

        $groups = $userObj->groups()->whereHas('school', function ($query) use ($groupObj) {
            $query->where('id', $groupObj->id);
        })->get();

        return view('users.groups.students.show', compact(['groupObj', 'userObj', 'groups']));
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
        $userObj = StudentService::getOrFail($groupObj, $user);

        return view('users.groups.students.delete', compact(['groupObj', 'userObj']));
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
        $userObj = StudentService::getOrFail($groupObj, $user);

        UserGroupService::detach($userObj, $groupObj);

        return redirect(action('Users\Groups\StudentController@index', [$groupObj->code]));
    }
}