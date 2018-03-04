<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 16/04/2017
 * Time: 23:07
 */

namespace App\_Classes;


use Exception;
use Illuminate\Support\Facades\File;


class Test
{
    private $source;
    private $test;


    function __construct($assignmentObj)
    {
        $this->source = env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . env('TEST_FILE');

        try {
            $testFile = File::get($this->source);
            $this->test = json_decode($testFile);
        }
        catch(Exception $e)
        {
            $this->test = null;
        }
    }

    public function toString()
    {
        $parsed = [];

        for($i = 0; $i < $this->test->testsCount; $i++){
            $test = $this->test->tests[$i];

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
}