<?php

namespace App\Http\Controllers\Assignments;

use App\Http\Controllers\Controller;

use App\Http\Requests\Test\SettingsRequest;

use Facades\App\Services\Assignments\AssignmentService;
use Facades\App\Services\Assignments\TestService;

class TestController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('assignmentAuthor');
    }

    public function show($code, $data)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $contents = TestService::toString($assignmentObj, $data);

        return view('assignments.tests.show',compact(['assignmentObj', 'data', 'contents']));
    }

    public function edit($code, $data)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $tests = TestService::loadData($assignmentObj, $data);

        return view('assignments.tests.edit',compact(['assignmentObj', 'data', 'tests']));
    }

    public function newTest($code, $data, Request $request)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $test = TestService::emptyTest($request->input('tasks', 0));

        return view('assignments.tests.test', compact(['assignmentObj', 'data', 'test']));
    }

    public function newTask($code, $data)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $task = TestService::emptyTask();

        return view('assignments.tests.test-task', compact(['assignmentObj', 'data', 'task']));
    }

    public function newLine($code, $data)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $line = TestService::emptyLine();

        return view('assignments.tests.test-line', compact(['assignmentObj', 'data', 'line']));
    }

    public function update($code, $data, Request $request)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        $tests = json_decode($request->tests);

        TestService::storeData($assignmentObj, $data, $tests);

        return redirect(action('Assignments\TestController@show', [$assignmentObj->code, $data]));
    }


    public function settings($code)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        return $assignmentObj;

        $settings = TestService::loadSettings($assignmentObj);
        $settings = (array)$settings;

        $defaults = TestService::defaultSettings();

        return view('assignments.tests.settings', compact(['assignmentObj','settings', 'defaults']));
    }

    public function postSettings($code, SettingsRequest $request)
    {
        $assignmentObj = AssignmentService::getOrFail($code);

        TestService::storeSettings($assignmentObj, $request->input());

        return redirect(action('Assignments\TestController@settings',$assignmentObj->code));
    }
}
