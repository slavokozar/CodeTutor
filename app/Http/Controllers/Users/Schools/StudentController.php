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
use Facades\App\Services\Users\Schools\StudentService;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($code)
    {
        $schoolObj = SchoolService::getOrFail($code);
        $users = $schoolObj->students;
        return view('users.schools.students.index', compact(['schoolObj', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(action('Users/UsersController@index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return redirect(action('Users/UsersController@index'));
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

        return view('users.schools.students.show', compact(['schoolObj', 'userObj']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect(action('Users/UsersController@index'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect(action('Users/UsersController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect(action('Users/UsersController@index'));
    }
}