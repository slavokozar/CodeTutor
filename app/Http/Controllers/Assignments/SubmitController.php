<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 15/08/2017
 * Time: 15:13
 */

namespace App\Http\Controllers\Assignments;


use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Facades\App\Services\Assignments\AssignmentService;
use Facades\App\Services\Assignments\SolutionService;

class SubmitController extends Controller
{
    private $hiddenFilesRegex = '^((.*_edited\.(c|c++|java))|main\.sh|result\.json|wrapper|__.*)$';

    public function __construct(){
        $this->middleware('auth');
    }


    public function show($code){
        $userObj = Auth::user();
        $assignmentObj = AssignmentService::getOrFail($code);

        $solutionObj = SolutionService::last($userObj, $assignmentObj);

        if ($solutionObj) {
            $scores = $solutionObj->scores;
            $scoresPoints = $scores->sum('points');
            $reviews = $solutionObj->reviews;
            $reviewsPoints = $reviews->sum('points');
        }

        $files = SolutionService::currentFiles($userObj, $assignmentObj);
        $resultFile = SolutionService::currentHasResultFile($userObj, $assignmentObj);

        return view('assignments.submit.show', compact(['assignmentObj', 'solutionObj', 'files', 'resultFile']));
    }


    public function upload($code, Request $request){

    }


    public function history($code){

    }
}