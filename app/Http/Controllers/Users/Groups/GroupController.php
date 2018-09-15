<?php

namespace App\Http\Controllers\Users\Groups;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\GroupRequest;

use Facades\App\Services\Users\Groups\GroupService;
use Facades\App\Services\Users\Schools\SchoolService;

use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('groups');
        $this->middleware('groups-view')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = GroupService::all();

        return view('users.groups.index', compact(['groups']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groupObj = GroupService::blank();
        $schools = SchoolService::all(Auth::user());

        return view('users.groups.edit', compact(['groupObj','schools']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $data = $request->all();
        $data['school_id'] = $data['school_id'] == '' ? null : $data['school_id'];
        $groupObj = GroupService::create($data);

        return redirect(action('Users\Groups\GroupController@show', [$groupObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($group)
    {
        $groupObj = GroupService::getOrFail($group);

        return view('users.groups.show', compact(['groupObj']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($group)
    {
        $groupObj = GroupService::getOrFail($group);
        $schools = SchoolService::all(Auth::user());

        return view('users.groups.edit', compact(['groupObj','schools']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, $group)
    {
        $groupObj = GroupService::getOrFail($group);

        $groupObj = GroupService::update($groupObj, $request->all());

        return redirect(action('Users\Groups\GroupController@show', $groupObj->code));
    }

    /**
     * Show modal fo destroy confirmation
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteModal($group)
    {
        $groupObj = GroupService::getOrFail($group);

        return view('users.groups.delete', compact(['groupObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($group)
    {
        $groupObj = GroupService::getOrFail($group);

        GroupService::destroy($groupObj);

        return redirect(action('Users/UsersController@index'));
    }
}
