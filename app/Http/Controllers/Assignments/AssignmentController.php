<?php

namespace App\Http\Controllers\Assignments;

use App\Http\Controllers\Controller;

use App\Http\Requests\AssignmentRequest;


use Facades\App\Services\ShareService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Facades\App\Services\Users\Groups\GroupService;
use Facades\App\Services\Users\UserService;
use Facades\App\Services\Assignments\AssignmentService;
use Facades\App\Services\Assignments\ProgrammingLanguageService;
use Illuminate\Support\Facades\Session;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }


    public function index()
    {

//        $groups = GroupService::all();
//        $assignments = AssignmentService::paginate(Auth::user(), Input::get('page', 1));

        $assignments = new Collection();
        return view('assignments.index', compact(['groups', 'assignments']));
    }


    public function show($code)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $content = AssignmentService::content($assignmentObj);
        $datapub = null;
//        $datapub = TestService::toString($assignmentObj, 'verejne');
        $comments = AssignmentService::comments($assignmentObj);

        return view('assignments.show', compact(['assignmentObj', 'content', 'datapub', 'comments']));
    }


    public function create()
    {
        $assignmentObj = AssignmentService::blank();

        Session::put('assignment_images', []);
        Session::put('assignment_attachments', []);

        $groups = UserService::managedGroups(Auth::user());
        $languages = ProgrammingLanguageService::all();

        return view('assignments.edit', compact(['assignmentObj', 'groups', 'languages']));
    }

    public function store(AssignmentRequest $request)
    {
        $assignmentObj = AssignmentService::store($request->input());

        ShareService::setSharing($assignmentObj, $request->input('share'));

        return redirect(action('Assignments\AssignmentController@show', [$assignmentObj->code]));
    }

    public function edit($code)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $groups = UserService::managedGroups(Auth::user());
        $languages = ProgrammingLanguageService::all();

        return view('assignments.edit', compact(['assignmentObj', 'groups', 'languages']));
    }

    public function update(AssignmentRequest $request, $code)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $assignmentObj = AssignmentService::update($assignmentObj, $request->input());

        ShareService::setSharing($assignmentObj, $request->input('share'));

        return redirect(action('Assignments\AssignmentController@show', [$assignmentObj->code]));
    }


    public function remove($code)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        return view('assignments.delete', compact(['assignmentObj']));
    }


    public function destroy($code)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        AssignmentService::delete($assignmentObj);

        return redirect(action('Assignments\AssignmentController@index'));
    }


}
