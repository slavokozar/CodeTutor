<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 29.4.18
 * Time: 19:46
 */

namespace App\Services\Assignments;


use App\Models\Assignments\TestData;
use Illuminate\Support\Facades\Response;

class DatapubService
{


    public function get($assignmentObj, $number){
        return $assignmentObj->datapubs()->where('number', $number)->first();
    }

    public function getOrFail($assignmentObj, $number){
        $datapubObj = $this->get($assignmentObj, $number);


        if($datapubObj == null){
            $this->fail($assignmentObj, $number);
        }
        return $datapubObj;
    }


    public function find($assignmentObj, $id){
        return $assignmentObj->datapubs()->where('id', $id)->first();
    }

    public function findOrFail($assignmentObj, $id){
        $datapubObj = $this->get($assignmentObj, $id);

        if($datapubObj == null){
            $this->fail($assignmentObj, $id);
        }
        return $datapubObj;
    }

    private function fail($assignmentObj, $number)
    {

        Response::make('Datapub #' . $number . 'not for assignment ' . $assignmentObj->code . ' found!', 404)->throwResponse();
    }
}