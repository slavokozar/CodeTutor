<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:42
 */

namespace App\Http\Controllers\Users\Groups;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\UserRequest;


use Facades\App\Services\Users\UserService;
use Facades\App\Services\Users\Groups\GroupService;
use Facades\App\Services\Users\Groups\StudentService;
use Facades\App\Services\Users\Groups\UserGroupService;


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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($group)
    {
        $groupObj = GroupService::getOrFail($group);

        $users = UserService::all();

        return view('users.groups.students.create', compact(['groupObj', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, $group)
    {
        $groupObj = GroupService::getOrFail($group);
        $userObj = UserGroupService::attach($request->input('users'), $groupObj);

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

        StudentService::destroy($groupObj, $userObj);

        return redirect(action('Users\Schools\StudentController@index', [$groupObj->code]));
    }
}