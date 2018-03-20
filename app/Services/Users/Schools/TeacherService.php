<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.3.18
 * Time: 1:05
 */

namespace App\Services\Users\Schools;


class TeacherService
{
    public function all($schoolObj)
    {
        return $schoolObj->teachers;
    }

    public function paginate($schoolObj)
    {
        return $schoolObj->teachers()->paginate(10);
    }
}