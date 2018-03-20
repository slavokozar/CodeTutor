<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 4.3.18
 * Time: 1:05
 */

namespace App\Services\Users\Schools;


class AdminService
{
    public function all($schoolObj)
    {
        return $schoolObj->admins;
    }

    public function paginate($schoolObj)
    {
        return $schoolObj->admins()->paginate(10);
    }
}