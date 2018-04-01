<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\Users\UserRequest;

use Facades\App\Services\Users\UserService;
use Facades\App\Services\Users\Groups\GroupService;
use Facades\App\Services\Users\Schools\SchoolService;
use Illuminate\Http\Request;


class UserController extends Controller
{
//    public function __construct(){
//        $this->middleware(['auth']);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserService::paginate();

        return view('users.users.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userObj = UserService::blank();

        return view('users.users.edit', compact(['userObj']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $userObj = UserService::create($request->all());

        return redirect(action('Users\UserController@show', [$userObj->code]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $userObj = UserService::getOrFail($user);

        $groups = $userObj->groups;
        $schools = $userObj->schools;

        return view('users.users.show', compact(['userObj', 'groups', 'schools']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $userObj = UserService::getOrFail($user);

        return view('users.users.edit', compact(['userObj']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $user)
    {
        $userObj = UserService::getOrFail($user);

        $userObj = UserService::update($userObj, $request->all());

        return redirect(action('Users\UserController@show', $userObj->code));
    }

    /**
     * Show modal fo destroy confirmation
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteModal($user)
    {
        $userObj = UserService::getOrFail($user);

        return view('users.users.delete', compact(['userObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $userObj = UserService::getOrFail($user);

        UserService::destroy($userObj);

        return redirect(action('Users\UserController@index'));
    }
}
