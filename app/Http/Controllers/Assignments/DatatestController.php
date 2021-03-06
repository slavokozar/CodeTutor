<?php

namespace App\Http\Controllers\Assignments;

use App\Http\Controllers\Controller;
use Facades\App\Services\Assignments\AssignmentService;
use Facades\App\Services\Assignments\DatatestService;
use Facades\App\Services\Assignments\TestdataService;
use Illuminate\Http\Request;

class DatatestController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdata = $assignmentObj->tests;
        $data = 'datatest';

        return view('assignments.testdata.index', compact(['assignmentObj', 'testdata', 'data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assignment)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdataObj = TestdataService::blank($assignmentObj);
        $data = 'datatest';

        return view('assignments.testdata.edit', compact(['assignmentObj', 'testdataObj', 'data']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store($assignment, Request $request)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdataObj = TestdataService::store($assignmentObj, $request->all(), 'datapub');

        return redirect(action('Assignments\DatatestController@show', [$assignmentObj->code, $testdataObj->number]));
    }

    public function show($assignment, $number)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdataObj = DatatestService::getOrFail($assignmentObj, $number);
        $data = 'datatest';

        return view('assignments.testdata.show', compact(['assignmentObj', 'testdataObj', 'data']));
    }

    public function edit($assignment, $number)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdataObj = DatatestService::getOrFail($assignmentObj, $number);
        $data = 'datatest';

        return view('assignments.testdata.edit', compact(['assignmentObj', 'testdataObj', 'data']));
    }

    public function update($assignment, $number, Request $request)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        $testdataObj = DatatestService::getOrFail($assignmentObj, $number, 'datatest');
        $testdataObj = TestdataService::update($assignmentObj, $testdataObj, $request->all());

        return redirect(action('Assignments\DatatestController@show', [$assignmentObj->code, $testdataObj->number]));
    }

    public function moveUp($assignment, $number)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        $testdataObj = DatatestService::getOrFail($assignmentObj, $number, 'datatest');
        $prevTestDataObj = DatatestService::get($assignmentObj, ($number - 1), 'datatest');

        if($prevTestDataObj != null){
            $testdataObj->number = $number - 1;
            $prevTestDataObj->number = $number;

            $testdataObj->save();
            $prevTestDataObj->save();
        }

        return redirect(action('Assignments\DatatestController@index', [$assignmentObj->code]));
    }

    public function moveDown($assignment, $number)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);

        $testdataObj = DatatestService::getOrFail($assignmentObj, $number, 'datapub');
        $nextTestDataObj = DatatestService::get($assignmentObj, ($number + 1), 'datapub');

        if($nextTestDataObj != null){
            $testdataObj->number = $number + 1;
            $nextTestDataObj->number = $number;

            $testdataObj->save();
            $nextTestDataObj->save();
        }

        return redirect(action('Assignments\DatatestController@index', [$assignmentObj->code]));
    }

    public function deleteModal($assignment, $number)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdataObj = DatatestService::getOrFail($assignmentObj, $number, 'datapub');
        $data = 'datapub';

        return view('assignments.testdata.delete', compact(['assignmentObj', 'testdataObj', 'data']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($assignment, $number)
    {
        $assignmentObj = AssignmentService::getOrFail($assignment);
        $testdataObj = DatatestService::getOrFail($assignmentObj, $number, 'datapub');

        TestdataService::delete($testdataObj);

        return redirect(action('Assignments\DatatestController@index', [$assignmentObj->code]));
    }
}
