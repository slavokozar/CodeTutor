<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 29.4.18
 * Time: 19:46
 */

namespace App\Services\Assignments;


use App\Models\Assignments\TestData;

class TestdataService
{
    public function blank($assignmentObj)
    {
        $tasks = [];
        for ($i = 0; $i < $assignmentObj->tasks; $i++) {
            $tasks[] = (object)[
                'linesCount' => 1,
                'lines' => [
                    (object)[
                        'value' => '',
                        'points' => 0,
                        'typedef' => 'String',
                        'precision' => 0
                    ]
                ]
            ];
        }

        $testdata = new TestData();
        $testdata->data = json_encode([
            'input' => (object)[
                'count' => 1,
                'inputs' => ['']
            ],
            'output' => (object)[
                'tasksCount' => $assignmentObj->tasks,
                'tasks' => $tasks
            ]
        ]);

        return $testdata;
    }

    public function store($assignmentObj, $data, $public)
    {
        $testdataObj = TestData::Create([
            'assignment_id' => $assignmentObj->id,
            'public' => $public == 'datapub',
            'number' => ($public == 'datapub' ? $assignmentObj->datapubs()->count() : $assignmentObj->tests()->count()) + 1,
            'timeout' => $data['timeout'],
            'description' => $data['description'],
            'data' => json_encode($this->dataToTest($assignmentObj, $data))
        ]);

        return $testdataObj;
    }


    public function update($assignmentObj, $testdataObj, $data)
    {
        $testdataObj->timeout = $data['timeout'];

        $testdataObj->description = $data['description'];
        $testdataObj->data = json_encode($this->dataToTest($assignmentObj, $data));

        $testdataObj->save();


        return $testdataObj->fresh();
    }


    public function delete($testdataObj){
        $number = $testdataObj->number;
        $public = $testdataObj->public;
        $assignment_id = $testdataObj->assignment_id;

        $testdataObj->delete();


        $testdata = TestData::where('assignment_id', $assignment_id)
            ->where('public', $public)
            ->where('number','>=', $number)
            ->orderBy('number', 'desc')->get();
        foreach($testdata as $testdataObj){
            $testdataObj->number = $testdataObj->number - 1;
            $testdataObj->save();
        }
    }


    private function dataToTest($assignmentObj, $data)
    {
        $tasks = [];
        for ($i = 0; $i < $assignmentObj->tasks; $i++) {
            $linesCount = count($data['value' . ($i + 1)]);
            $lines = [];

            for ($j = 0; $j < $linesCount; $j++) {

                $value = $data['value' . ($i + 1)][$j];
                $value = $data['type' . ($i + 1)][$j] == 'Integer' ? intval($value) : $value;
                $value = $data['type' . ($i + 1)][$j] == 'Double' ? doubleval($value) : $value;

                $lines[] = (object)[
                    'value' => $value,
                    'points' => doubleval($data['points' . ($i + 1)][$j]),
                    'typedef' => $data['type' . ($i + 1)][$j],
                    'precision' => isset($data['precision' . ($i + 1)][$j]) ? doubleval($data['precision' . ($i + 1)][$j]) : 0,
                ];
            }

            $tasks[] = (object)[
                'linesCount' => $linesCount,
                'lines' => $lines
            ];
        }


        return (object)[
            'input' => (object)[
                'count' => count($data['input']),
                'inputs' => $data['input']
            ],
            'output' => (object)[
                'tasksCount' => $assignmentObj->tasks,
                'tasks' => $tasks
            ]
        ];
    }

}