<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 17/09/2017
 * Time: 19:58
 */

namespace App\Services\Assignments;

use App\Models\ProgrammingLanguage;

class ProgrammingLanguageService
{
    public function all()
    {
        return ProgrammingLanguage::all();
    }
}