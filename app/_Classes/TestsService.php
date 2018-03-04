<?php
/**
 * Created by PhpStorm.
 * User: lukas
 * Date: 29.09.16
 * Time: 23:22
 */

namespace App\_Classes;


use App\Models\Assignment;
use App\Models\User;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use ZipArchive;

class TestsService
{
    public function testToString($assignmentObj)
    {
        try {
            $testFile = File::get(env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . env('TEST_FILE'));
            $testFile = json_decode($testFile);

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

        }
        catch(Exception $e)
        {
            $parsed = null;
        }

        return $parsed;
    }

    public function datapubToString($assignmentObj)
    {
        try {
            $testFile = File::get(env('TEST_PATH') . '/' . $assignmentObj->code . '/test/' . env('DATAPUB_FILE'));
            $testFile = json_decode($testFile);

            $parsed = [];

            for($i = 0; $i < $testFile->testsCount; $i++){
                $test = $testFile->tests[$i];

                $output = '';
                $tasks = [];
                for($taskNo = 0; $taskNo < $test->output->tasksCount; $taskNo++){
                    $output .= '##TASK' . ($taskNo + 1) . PHP_EOL;
                    $lines = [];
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

        }
        catch(Exception $e)
        {
            $parsed = null;
        }

        return $parsed;
    }

}