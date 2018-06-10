<?php

namespace App\Http\Controllers\Assignments;

use App\Http\Controllers\Controller;

use App\Http\Requests\AssignmentRequest;


use Facades\App\Services\Files\ImageService;
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
        $assignments = AssignmentService::paginate();

        return view('assignments.index', compact(['assignments']));
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
        $assignmentObj = AssignmentService::store($request->input(), Auth::user());

        $images = Session::get('assignment_images', []);
        foreach($images as $image){
            $imageObj = ImageService::findOrFail($image);
            $imageObj->object_id = $assignmentObj->id;
            $imageObj->object_type = 'assignment';
            $imageObj->save();
        }

        $attachments = Session::get('assignment_attachments', []);
        foreach($attachments as $attachment){

        }

        ShareService::setSharing($assignmentObj, $request->input('share'), true);

        return redirect(action('Assignments\AssignmentController@show', [$assignmentObj->code]));
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

        ShareService::setSharing($assignmentObj, $request->input('share'), true);

        return redirect(action('Assignments\AssignmentController@show', [$assignmentObj->code]));
    }


    public function deleteModal($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        return view('assignments.delete',compact(['assignmentObj']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        AssignmentService::destroy($assignmentObj);

        return redirect(action('Assignments\AssignmentController@index'));
    }


}
