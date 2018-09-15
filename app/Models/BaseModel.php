<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 13.9.18
 * Time: 22:50
 */

namespace App\Models;


class BaseModel extends Eloquent
{


    public static function getTableName()
    {
        return with(new static)->getTable();
    }


}