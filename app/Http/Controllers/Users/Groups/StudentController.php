<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:42
 */

namespace App\Http\Controllers\Users\Schools;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\UserRequest;

use Facades\App\Services\Users\Schools\SchoolService;
use Facades\App\Services\Users\Schools\StudentService;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($school)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $users = StudentService::paginate($schoolObj);

        return view('users.schools.students.index', compact(['schoolObj','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($school)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::blank($schoolObj);

        return view('users.schools.students.edit', compact(['schoolObj', 'userObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, $school)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::create($schoolObj, $request->all());

        return redirect(action('Users\Schools\StudentController@show', [$schoolObj->code, $userObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($school, $user)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::getOrFail($schoolObj, $user);

        $groups = $userObj->groups()->whereHas('school', function ($query) use ($schoolObj) {
            $query->where('id', $schoolObj->id);
        })->get();

        return view('users.schools.students.show', compact(['schoolObj', 'userObj', 'groups']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($school, $user)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::getOrFail($schoolObj, $user);

        return view('users.schools.students.edit', compact(['schoolObj', 'userObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $school, $user)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::getOrFail($schoolObj, $user);

        $userObj = StudentService::update($schoolObj, $userObj, $request->all());

        return redirect(action('Users\Schools\StudentController@show', [$schoolObj->code, $userObj->code]));
    }

    /**
     * Show modal fo destroy confirmation
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteModal($school, $user)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::getOrFail($schoolObj, $user);

        return view('users.schools.students.delete', compact(['schoolObj', 'userObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($school, $user)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = StudentService::getOrFail($schoolObj, $user);

        StudentService::destroy($schoolObj, $userObj);

        return redirect(action('Users\Schools\StudentController@index', [$schoolObj->code]));
    }
}