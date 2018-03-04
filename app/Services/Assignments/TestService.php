<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 29.09.16
 * Time: 23:22
 */

namespace App\Services\Assignments;


use App\Models\Assignment;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use ZipArchive;

use Facades\App\Services\Assignments\AssignmentService as AssignmentServiceFacade;

class TestService
{



    public function loadSettings($assignmentObj){
        $path = AssignmentServiceFacade::path($assignmentObj, 'settings.json');

        if (!File::exists($path)){
            return $this->storeSettings($assignmentObj);

        }

        $contents = File::get($path);

        return json_decode($contents);
    }

    public function storeSettings($assignmentObj, $data = null){
        $path = AssignmentServiceFacade::path($assignmentObj, 'settings.json');

        if($data == null){
            $data = $this->defaultSettings();
        }else{
            $settings = [];
            foreach($assignmentObj->programmingLanguages as $programmingLanguage){
                $params = [];

                if(isset($data['timeout_' . $programmingLanguage->code])){
                    $params['timeout'] = $data['timeout_' . $programmingLanguage->code];
                }

                if(isset($data['options_basic_' . $programmingLanguage->code])){
                    $params['options_basic'] = $data['options_basic_' . $programmingLanguage->code];
                }

                if(isset($data['options_extended_' . $programmingLanguage->code])){
                    $params['options_extended'] = $data['options_extended_' . $programmingLanguage->code];
                }

                $settings[$programmingLanguage->code] = count($params > 0) ? $params : null;
            }

            $data = $settings;
        }

        File::put($path, json_encode($data));

        return $data;
    }

    public function defaultSettings(){
        return [
            'c' => (object)[
                'timeout' => 800,
                'options_basic' => ['std=c99', 'Wall', 'lm', 'pedantic', 'Wextra'],
                'options_extended' => ['std=c99', 'Wall', 'lm', 'pedantic', 'Wextra']
            ],
            'cpp' => (object)[
                'timeout' => 800,
                'options_basic' => ['std=c++11', 'Wall', 'pedantic'],
                'options_extended' => ['std=c++11', 'Wall', 'pedantic']
            ],
            'java' => null
        ];
    }

    public function loadData($assignmentObj, $data)
    {
        if($data == 'verejne'){
            $path = AssignmentServiceFacade::path($assignmentObj, 'data_public.json');
        }elseif($data == 'testovacie'){
            $path = AssignmentServiceFacade::path($assignmentObj, 'data_test.json');
        }

        if (!File::exists($path)){
            return $this->storeData($assignmentObj, $data);
        }

        $testsFile = File::get($path);
        $tests = json_decode($testsFile);

        return $tests;
    }

    public function toString($assignmentObj, $data){
        $testFile = $this->loadData($assignmentObj, $data);

        $parsed = [];

        for($i = 0; $i < $testFile->testsCount; $i++){
            $test = $testFile->tests[$i];

            $output = '';
            for($taskNo = 0; $taskNo < $test->output->tasksCount; $taskNo++){
                $output .= '##TASK' . ($taskNo + 1) . PHP_EOL;
                foreach($test->output->tasks[$taskNo]->lines as $line){
                    $output .= $line->value . PHP_EOL;
                }
            }

            $data = (object)[
                'input' => implode (PHP_EOL, $test->input->inputs),
                'output' => $output
            ];
            $parsed[] = $data;
        }

        return $parsed;
    }

    public function storeData($assignmentObj, $data, $content = null){

        if($data == 'verejne'){
            $path = AssignmentServiceFacade::path($assignmentObj, 'data_public.json');
        }elseif($data == 'testovacie'){
            $path = AssignmentServiceFacade::path($assignmentObj, 'data_test.json');
        }

        if($content == null) {
            $content = $this->defaultData();
        }

        File::put($path, json_encode($content));


        return $content;
    }

    public function defaultData(){
        return (object)[
            'testsCount' => 0,
            'tests' => []
        ];
    }

    public function emptyLine(){
        return (object)[
            'value' => '',
            'points' => 0,
            'typedef' => 'String',
            'precision' => 0
        ];
    }

    public function emptyTask(){
        return (object)[
            'linesCount' => 1,
            'lines' => [
                $this->emptyLine()
            ]
        ];
    }

    public function emptyTest($tasksCount){
        $tasks = [];
        for($i = 0; $i < $tasksCount; $i++){
            $tasks[] = $this->emptyTask();
        }

//        dd($tasks);

        return (object)[
            'description' => '',
            'timeout' => '1000',
            'input' => (object)[
                'count' => 0,
                'inputs' => []
            ],
            'output' => (object)[
                'tasksCount' => $tasksCount,
                'tasks' => $tasks
            ]
        ];
    }

}