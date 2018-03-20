<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.3.18
 * Time: 1:05
 */

namespace App\Services\Users\Schools;


use Illuminate\Support\Facades\Response;

class StudentService
{
    public function all($schoolObj)
    {
        return $schoolObj->students;
    }

    public function paginate($schoolObj)
    {
        return $schoolObj->students()->paginate(10);
    }

    public function getOrFail($schoolObj, $code)
    {
        $schoolObj = $this->get($schoolObj, $code);

        if ($schoolObj == null) {
            $this->fail($schoolObj, $code);
        } else {
            return $schoolObj;
        }
    }

    private function get($schoolObj, $code)
    {
        return $schoolObj->students()->where('code', $code)->first();
    }

    private function fail($schoolObj, $code)
    {
        Response::make('Student ' . $code . 'not found!', 404);
    }

}