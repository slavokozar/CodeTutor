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

class _TestController extends Controller
{

    public function show($code)
    {
        $assignmentObj = Assignment::where('code', $code)->first();

        if ($assignmentObj == null) {
            return redirect(action('Assignments\AssignmentController@index'));
        }

        $datapub = TestsServiceFacade::datapubToString($assignmentObj);
        $tests = TestsServiceFacade::testToString($assignmentObj);

        return view('assignments.tests.show',compact(['assignmentObj', 'datapub', 'tests']));
    }

    public function editTests($code)
    {
        $assignmentObj = Assignment::where('code',$code)->first();

        try
        {
            $tests = File::get(env('TEST_PATH').'/'.$assignmentObj->code.'/test/'.env('TEST_FILE'));
            $tests = json_decode($tests);
        }
        catch(Exception $e)
        {
            $tests = null;
        }

        $submitLanguages = [];
        foreach($tests->compilation->languages as $language){
            if(isset($language->options)){
                $submitLanguages[$language->language] = [
                    'timeout' => $language->timeout,
                    'options-basic' => $language->options->basic,
                    'options-extended' => $language->options->extended
                ];
            }else{
                $submitLanguages[$language->language] = [];
            }
        }

        $languages = [
            (object)[
                'name'=> 'c',
                'compilation' => true,
                'options' => ['std=c99', 'Wall', 'lm', 'pedantic', 'Wextra']
            ],
            (object)[
                'name'=> 'c++',
                'compilation' => true,
                'options' => ['std=c++11', 'Wall', 'pedantic']

            ],
            (object)[
                'name'=> 'java',
                'compilation' => false
            ],
        ];

        return view('assignments.tests.index',compact(['assignmentObj','tests','submitLanguages','languages']));
    }

    public function createTest(Request $request, $code)
    {
        $assignmentObj = Assignment::where('code',$code)->first();

        $count = intval($request->tasks);
        $test = $this->emptyTest($count);

        return view('assignments.tests.test', compact(['assignmentObj','test','count']));
    }

    public function createTask($code)
    {
        $assignmentObj = Assignment::where('code',$code)->first();

        $task = $this->emptyTask();
        return view('assignments.tests.test-task', compact(['assignmentObj','task']));
    }

    public function createLine($code)
    {
        $assignmentObj = Assignment::where('code',$code)->first();

        $line = $this->emptyLine();
        return view('assignments.tests.test-line', compact(['assignmentObj', 'line']));
    }

    public function update($code, Request $request)
    {
        $assignmentObj = Assignment::where('code',$code)->first();
        $datapubFile = env('TEST_PATH').'/'.$assignmentObj->code.'/test/'.env('DATAPUB_FILE');
        $testsFile = env('TEST_PATH').'/'.$assignmentObj->code.'/test/'.env('TEST_FILE');

        $tests = json_decode($request->tests);

        File::put($testsFile, json_encode($tests));

        return redirect(action('Assignments\TestController@edit', [$assignmentObj->code]));
    }


    private function emptyLine(){
        return (object)[
            'value' => '',
            'points' => 0,
            'typedef' => 'String',
            'precision' => 0
        ];
    }

    private function emptyTask(){
        return (object)[
            'linesCount' => 1,
            'lines' => [
                $this->emptyLine()
            ]
        ];
    }

    private function emptyTest($count = 1){

        $tasks = [];
        for($i = 0; $i < $count; $i++){
            $tasks[] = $this->emptyTask();
        }

        return (object)[
            'description' => '',
            'timeout' => '1000',
            'input' => (object)[
                'count' => 0,
                'inputs' => []
            ],
            'output' => (object)[
                'tasksCount' => $count,
                'tasks' => $tasks
            ]
        ];
    }

    private function compilation(){
        return (object)[
            'languages' =>[
                (object)[
                    'language' => 'c',
                    'timeout' => 1000,
                    'options' => (object)[
                        'basic' => ['std=c99','Wall', 'lm'],
                        'extended' => ['pedantic','Wextra']
                    ]
                ],
                (object)[
                    'language' => 'c++',
                    'timeout' => 2000,
                    'options' => (object)[
                        'basic' => ['std=c++11','Wall'],
                        'extended' => ['pedantic']
                    ]
                ],
                (object)[
                    'language' => 'java',
                    'timeout' => 4000,
                    'options' => (object)[
                        'basic' => [],
                        'extended' => []
                    ]
                ]
            ]
        ];
    }
}
