<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 2.3.18
 * Time: 23:42
 */

namespace App\Http\Controllers\Users\Schools;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\SchoolRequest;

use Facades\App\Services\Users\Schools\SchoolService;


class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = SchoolService::all();

        return view('users.schools.index', compact(['schools']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schoolObj = SchoolService::blank();

        return view('users.schools.edit', compact(['schoolObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolRequest $request)
    {
        $schoolObj = SchoolService::create($request->all());

        return redirect(action('Users\Schools\SchoolController@show', [$schoolObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($school)
    {
        $schoolObj = SchoolService::getOrFail($school);

        return view('users.schools.show', compact(['schoolObj']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($school)
    {
        $schoolObj = SchoolService::getOrFail($school);

        return view('users.schools.edit', compact(['schoolObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolRequest $request, $school)
    {
        $schoolObj = SchoolService::getOrFail($school);

        $schoolObj = SchoolService::update($schoolObj, $request->all());

        return redirect(action('Users\Schools\SchoolController@show', $schoolObj->code));
    }

    /**
     * Show modal fo destroy confirmation
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteModal($school)
    {
        $schoolObj = SchoolService::getOrFail($school);

        return view('users.schools.delete', compact(['schoolObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($school)
    {
        $schoolObj = SchoolService::getOrFail($school);

        SchoolService::destroy($schoolObj);

        return redirect(action('Users/UsersController@index'));
    }
}