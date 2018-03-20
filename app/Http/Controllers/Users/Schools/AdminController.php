<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:42
 */

namespace App\Http\Controllers\Users\Schools;

use App\Http\Controllers\Controller;

use Facades\App\Services\Users\Schools\SchoolService;
use Facades\App\Services\Users\Schools\AdminService;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($school)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $users = AdminService::paginate($schoolObj);

        return view('users.schools.admins.index', compact(['schoolObj','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($school)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = AdminService::blank($schoolObj);

        return view('users.schools.admins.edit', compact(['schoolObj', 'userObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $school)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = AdminService::create($schoolObj, $request->all());

        return redirect(action('Users\Schools\AdminController@show', [$schoolObj->code, $userObj->code]));
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
        $userObj = AdminService::gerOrFail($schoolObj, $user);

        return view('users.schools.admins.show', compact(['schoolObj', 'userObj']));
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
        $userObj = AdminService::gerOrFail($schoolObj, $user);

        return view('users.schools.admins.edit', compact(['schoolObj', 'userObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $school, $user)
    {
        $schoolObj = SchoolService::getOrFail($school);
        $userObj = AdminService::gerOrFail($schoolObj, $user);

        $userObj = AdminService::update($schoolObj, $request->all());

        return redirect(action('Users\Schools\AdminController@show', [$schoolObj->code, $userObj->code]));
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
        $userObj = AdminService::getOrFail($schoolObj, $user);

        return view('users.schools.admins.delete', compact(['schoolObj', 'userObj']));
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
        $userObj = AdminService::getOrFail($schoolObj, $user);

        AdminService::destroy($schoolObj, $userObj);

        return redirect(action('Users\Schools\AdminController@index'));
    }
}