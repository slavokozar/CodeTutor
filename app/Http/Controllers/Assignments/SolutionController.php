<?php

namespace App\Http\Controllers\Assignments;

use App\Facades\TestsServiceFacade;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class SolutionController extends Controller
{
    public function index($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        $testPath = env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . env('TEST_FILE');

        if (!File::exists($testPath)) {
            $errors = ['TestFile not found!'];
            return view('assignments.solutions', compact(['assignmentObj', 'errors']));

        }

        $contents = File::get($testPath);
        $tests = json_decode($contents);

        $tasksCount = $tests->tests[0]->output->tasksCount;

        $tasksMaxPoints = [];
        $maxPoints = 0;
        for ($i = 0; $i < $tasksCount; $i++) {
            $linesCount = $tests->tests[0]->output->tasks[$i]->linesCount;
            $tasksMaxPoints[$i] = 0;
            for ($j = 0; $j < $linesCount; $j++) {
                $tasksMaxPoints[$i] += $tests->tests[0]->output->tasks[$i]->lines[$j]->points;
            }
            $maxPoints += $tasksMaxPoints[$i];
        }

        $testsCount = 1;

        return view('assignments.solutions.index', compact(['assignmentObj', 'testsCount', 'tasksCount', 'tasksMaxPoints', 'maxPoints']));
    }
}
